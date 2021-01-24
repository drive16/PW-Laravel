@extends('layouts.master')

@section('titolo')
{{ trans('labels.networkConfigurator') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="active"><a href="{{ route('home') }}">Home</a></li>
<li><a href="{{ route('router.index') }}">Routers</a></li>
<li><a href="{{ route('switch.index') }}">Switches</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.quickConfiguration') }}<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('routerConfiguration.index') }}">Router</a></li>
        <li><a href="{{ route('switchConfiguration.index') }}">Switch</a></li>
    </ul>
</li>
@endsection

@section('breadcrumb')
<li><a class="active">Home</a></li>
@endsection

@section('corpo')
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="row">
            <div class="col-sm-9">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{ url('/') }}/img/isr4000.jpg" alt="ISR serie 4000">
                        <div class="carousel-caption hidden-xs hidden-sm hidden-md">
                            <h4>{{ trans('labels.series4000') }}</h4>
                            <p>{{ trans('labels.newGeneration') }}</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="{{ url('/') }}/img/2900.jpg" alt="ISR serie 2000">
                        <div class="carousel-caption hidden-xs hidden-sm hidden-md">
                            <h4>{{ trans('labels.series2000') }}</h4>
                            <p>{{ trans('labels.oldGeneration') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="col-sm-3">
                <p>{{ trans('labels.welcomeMessage') }}</p>
                <p>{{ trans('labels.welcomeExplanation') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <header class="header-section">
        <h3>{{ trans('labels.why') }}</h3>
    </header>
</div>

<div class="container">
    <p>{{ trans('labels.explanation') }}</p>
</div>
@endsection