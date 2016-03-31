<?php

namespace App\Services;


use Khill\Lavacharts\Lavacharts;


class ChartService
{


    protected $chartGraph = array(
        'chart_gender' => array(
            'type' =>'PieChart',
            'percent_id' => 'chart_gender_percent',
            'index_id' => 'chart_gender_index',
            'title' => 'Gender',
        ),
        'chart_age' => array(
            'type' =>'ColumnChart',
            'percent_id' => 'chart_age_percent',
            'index_id' => 'chart_age_index',
            'title' => 'Age',
        ),
        'chart_income' => array(
            'type' =>'ColumnChart',
            'percent_id' => 'chart_income_percent',
            'index_id' => 'chart_income_index',
            'title' => 'Household Income',
        ),
        'chart_ethnicity' => array(
            'type' =>'DonutChart',
            'percent_id' => 'chart_ethnicity_percent',
            'index_id' => 'chart_ethnicity_index',
            'title' => 'Minority Report',
        ),
        'chart_education' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_education_percent',
            'index_id' => 'chart_education_index',
            'title' => 'Education',
        )
    );

    public function getCharts($data)
    {

        foreach($data as $chartType => $dataTypeArray)
        {

            foreach($dataTypeArray as $dataType => $traits)
            {

                $function = 'get' . $dataType . 'Chart';

                $chart[$chartType][$dataType] = $this->$function($chartType, $traits);

            }
        }

        return $chart;
    }


    public function getpercentChart($chartType, $traits)
    {
        //$lava = new Lavacharts();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartType)
            ->addNumberColumn($this->chartGraph[$chartType]['title']);

        foreach($traits as $trait => $value)
        {
            $table->addRow([$trait, $value]);
        }

        $type = $this->chartGraph[$chartType]['type'];

        \Lava::$type($this->chartGraph[$chartType]['percent_id'],$table,[

            'title' => $this->chartGraph[$chartType]['title'],

        ]);

        return \Lava::render($this->chartGraph[$chartType]['type'],$this->chartGraph[$chartType]['percent_id'],$this->chartGraph[$chartType]['percent_id']);
    }



    public function getindexChart($chartType, $traits)
    {
        //$lava = new Lavacharts();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartType)
            ->addNumberColumn('Index');

        foreach($traits as $trait => $value)
        {
            $table->addRow([$trait, $value]);
        }

        \Lava::BarChart($this->chartGraph[$chartType]['index_id'],$table,[

            'title' => 'Over / Under Index',
            'legend' => [
                'position' => 'none'
            ],
        ]);

        $render = \Lava::render('BarChart',$this->chartGraph[$chartType]['index_id'],$this->chartGraph[$chartType]['index_id']);

        return $render;

    }

}