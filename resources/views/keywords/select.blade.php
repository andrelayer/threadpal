@extends('layouts.app')

@section('content')

    @include('pages/_navbar')
    <div class="container spark-screen reportcontainer">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Select which one is correct</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'reports']) !!}

                        @foreach($autocomplete as $keyword)

                            <div class="form-group">
                                {!! Form::radio('name',$keyword['name']) !!}

                                {{$keyword['name'] }} - {{$keyword['reach']}} People

                                {!! form::hidden($keyword['name'],$keyword['id']) !!}
                            </div>

                        @endforeach

                        {!! Form::submit('Submit',['class' => 'btn btn-primary form-control']) !!}

                        {!! Form::close() !!}

                        @include('errors.list')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
