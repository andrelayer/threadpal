@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create A Report</div>

                    <div class="panel-body">
                        {!! Form::model($report = new \App\Report, ['url' => 'reports']) !!}

                        <div class="form-group">
                            {!! Form::label('name','Report Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('keyword','Keyword:') !!}
                            {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::close() !!}

                        @include('errors/list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
