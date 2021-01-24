@extends('layouts.master')

@section('titolo')
{{ trans('labels.routerTitle') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active"><a href="{{ route('router.index') }}">Router</a></li>
<li><a href="{{ route('switch.index') }}">Switch</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.quickConfiguration') }}<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('routerConfiguration.index') }}">Router</a></li>
        <li><a href="{{ route('switchConfiguration.index') }}">Switch</a></li>
    </ul>
</li>
@endsection

@section('breadcrumb')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active">Routers</li>
<li class="active">{{ trans('labels.deleteRouter') }}</li>
@endsection

@section('corpo')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h1>
                    {{ trans('labels.routerDeleteMessage') }}
                </h1>
            </header>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class='panel-heading'>
                    {{ trans('labels.illegalAccess') }}
                </div>
                <div class='panel-body'>
                    <p>{{ trans('labels.wrong') }}</p>
                    <p><a class="btn btn-default" href="{{ route('home') }}"><span class='glyphicon glyphicon-log-out'></span> {{ trans('lables.backHome') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
