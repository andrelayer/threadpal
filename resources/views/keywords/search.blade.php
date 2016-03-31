@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen reportcontainer">
        <div class="row">
            @include('flash::message')
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Enter in Company Name</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'keywords']) !!}

                        <div class="form-group">
                            {!! Form::label('keyword','Company:') !!}
                            {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">

                            {!! Form::submit("Search", ['class' => 'btn btn-primary form-control']) !!}
                        </div>

                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
