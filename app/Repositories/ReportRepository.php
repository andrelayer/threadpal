<?php

namespace App\Repositories;
use App\Report;
use App\Chart_Gender;
use App\Chart_Age;
use App\Chart_Income;
use App\Chart_Ethnicity;
use App\Chart_Education;

class ReportRepository{


    protected $reportType = array(
        'main'=> array('Chart_Gender','Chart_Age','Chart_Income','Chart_Ethnicity','Chart_Education'),
    );

    public function store($data, $keywordId, $name, $slug, $type)
    {
        $report = new Report();

        $report->type = $type;
        $report->name = $name;
        $report->keywords = $keywordId;
        $report->slug = $slug;

        $report->save();


        foreach($data as $table => $columns)
        {
            $class = "App\\" . $table;

            $chart = new $class($columns);

            $report->$table()->save($chart);

        }


        return $report;

    }

    public function checkReportExistence($keywordId)
    {

        return Report::where('keywords',$keywordId)->first();
    }

    public function getReport($id)
    {
        return Report::find($id);
    }

    public function getMasterReport($type)
    {
        return Report::where('name','master')->where('type',$type)->first();
    }

    public function update($id, $data, $keywordId, $name)
    {
        $report = Report::find($id);

        $report->name = $name;
        $report->keywords = $keywordId;

        $report->save();

        foreach($data as $table => $columns)
        {
            $class = "App\\" . $table;

            $chart = $class::where('report_id',$report->id)->first();

            if(isset($chart))
            {

                $chart->update($columns);

            }else
            {
                $chart = new $class($columns);

                $report->$table()->save($chart);
            }



        }

        return $report;

    }




}