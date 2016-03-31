@extends('layouts.app')

@section('content')

    @include('pages/_navbar')

    <div class="container spark-screen reportcontainer">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $report->name }} - Report</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div id="chart_gender_percent"></div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <div id="chart_gender_index"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_age_percent"></div>
                            </div>

                            <div class="col-md-6">
                                <div id="chart_age_index"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_income_percent"></div>
                            </div>

                            <div class="col-md-6">
                                <div id="chart_income_index"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_ethnicity_percent"></div>
                            </div>

                            <div class="col-md-6">
                                <div id="chart_ethnicity_index"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_education_percent"></div>
                            </div>

                            <div class="col-md-6">
                                <div id="chart_education_index"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @foreach ($charts as $chart)
            @foreach ($chart as $script)
                {!! $script !!}
            @endforeach
        @endforeach


    </div>

    <script type="text/javascript">
        function getImageCallback (event, chart) {
            console.log(chart.getImageURI());
            // This will return in the form of "data:image/png;base64,iVBORw0KGgoAAAAUA..."
        }
    </script>
@endsection
