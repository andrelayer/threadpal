<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\ChartService;

class ReportController extends Controller
{

    protected $reportService;
    protected $chartService;

    public function __construct(ReportService $reportService, ChartService $chartService)
    {
        $this->reportService = $reportService;
        $this->chartService = $chartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReportService $reportService)
    {
        $report = $reportService->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $input)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ReportService $reportService)
    {
        $keywordName = $request['name'];

        $keyName = str_replace(' ', '_', trim($keywordName));

        $keywordId = $request->input($keyName);

        $report = $reportService->create($keywordName, $keywordId);

        //$report = $reportService->create();

        $reportView = 'reports/' . $report->id;

        return redirect($reportView);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $report = $this->reportService->getReport($id);

        $data = $this->reportService->show($id);

        $charts = $this->chartService->getCharts($data);

       /* print_r($charts);
        die();*/

        return view('reports.show', compact('charts', 'report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
