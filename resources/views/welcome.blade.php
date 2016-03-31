@extends('layouts.app')

@section('content')

    @include('pages/_navbar')

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Simple, Powerful<br/>Brand Data & Marketing</h1>
                <hr>
                <p>ThreadPal can help you do brand research and marketing easily and without ridiculous costs.  Just look up a company or brand to see their full report.</p>
                <a href="{{ url('/keywords') }}" class="btn btn-primary btn-xl page-scroll">Start Here</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got what you need!</h2>
                    <hr class="light">
                    <p class="text-faded">Get an audience breakdown for any brand or company.  Easily look up gender, income, age, ethnicity, spending habits, etc.. breakdowns.</p>

                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>Reports</h3>
                        <p class="text-muted">Create brand reports easily.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Indexes</h3>
                        <p class="text-muted">Every report shows how a brand's audience compares to the general public.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Marketing</h3>
                        <p class="text-muted">Easily create ads targeted towards a brand that matches the audience you're looking for.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Made with Love</h3>
                        <p class="text-muted">We love what we do and hope you do to :)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
