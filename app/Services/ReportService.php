<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;


use App\Services\ConnectionService;
use App\Repositories\ChartRepository;
use App\Services\TokenService;
use App\Repositories\ReportRepository;
use App\Services\SlugService;



class ReportService{


    protected $reportType = array(
        'main'=> array('chart_gender','chart_age','chart_income','chart_ethnicity','chart_education'),
    );


    protected $connectionService;
    protected $chartRepository;
    protected $tokenService;
    protected $reportRepository;
    protected $slugService;


    public function __construct(SlugService $slugService,ConnectionService $connectionService, ChartRepository $chartRepository, TokenService $tokenService, ReportRepository $reportRepository)
    {
        $this->slugService = $slugService;
        $this->connectionService = $connectionService;
        $this->chartRepository = $chartRepository;
        $this->tokenService = $tokenService;
        $this->reportRepository = $reportRepository;
    }

    public function create($keywordName = NULL, $keywordId = NULL, $type = 'main')
    {

        if($keywordId == NULL && $keywordName == NULL)
        {
            $name = 'master';

            $report = $this->getMasterReport($type);

        }else{

            $name = $keywordName;

            $report = $this->checkReportExistence($keywordId);
        }




        $tokenCollection = $this->tokenService->getToken('facebook');

        foreach ($this->reportType[$type] as $chart)
        {
            $data[$chart] = $this->chartRepository->$chart($tokenCollection->token, $keywordName, $keywordId);
        }


        //check if keywords exist in database
        //if no, create slug and store
        //if yes, update





        if(isset($report)){

            $finalReport = $this->update($report->id, $data, $keywordId, $name);

        }else {

            $slug = str_slug($name);

            $finalReport = $this->store($data, $keywordId, $name, $slug);


        }

        return $finalReport;

    }

    public function store($data, $keywordId, $name, $slug, $type = 'main')
    {
        return $this->reportRepository->store($data, $keywordId, $name, $slug, $type);
    }

    public function show($id)
    {
        //get report
        //get report type
        //loop through charts for report type and get data for that report
        //get master report charts for report type
        //do indexing math

        $report = $this->getReport($id);

        $masterReport = $this->getMasterReport($report->type);

        foreach ($this->reportType[$report->type] as $chart)
        {
            $tempCollection = $this->chartRepository->getChartData($report->id,$chart);

            unset($tempCollection->id);
            unset($tempCollection->report_id);
            unset($tempCollection->created_at);
            unset($tempCollection->updated_at);

            $reportData[$chart] = $tempCollection;
        }

        foreach ($this->reportType[$report->type] as $chart)
        {
            $tempCollection = $this->chartRepository->getChartData($masterReport->id,$chart);

            unset($tempCollection->id);
            unset($tempCollection->report_id);
            unset($tempCollection->created_at);
            unset($tempCollection->updated_at);

            $masterReportData[$chart] = $tempCollection;
        }

        foreach ($reportData as $chart => $data)
        {
            $chartTotal = $data->total;
            $masterTotal = $masterReportData[$chart]->total;

            foreach($data as $trait => $value)
            {
                if($trait != 'total')
                {
                    $chartPercent = $value / $chartTotal;

                    $masterPercent = $masterReportData[$chart]->$trait / $masterTotal;

                    $index = ($chartPercent - $masterPercent)/$masterPercent *100;

                    $calculatedData[$chart]['percent'][$trait] = round($chartPercent,10);
                    $calculatedData[$chart]['index'][$trait] = round($index);
                }
            }

        }

        return $calculatedData;


    }

    public function update($id, $data, $keywordId, $name)
    {
        return $this->reportRepository->update($id,$data, $keywordId, $name);
    }

    public function checkReportExistence($keywordId)
    {
        return $this->reportRepository->checkReportExistence($keywordId);
    }

    public function getMasterReport($type)
    {
        return $this->reportRepository->getMasterReport($type);
    }

    public function getReport($id)
    {
        return $this->reportRepository->getReport($id);
    }
}