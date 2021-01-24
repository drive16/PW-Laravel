@extends('layouts.master')

@section('titolo')
{{ trans('labels.deleteConfigurationRouterTitle') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active"><a href="{{ route('router.index') }}">Routers</a></li>
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
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active">Routers</li>
<li class="active">{{ trans('labels.deleteRouter') }}</li>
@endsection

@section('corpo')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h2>{{ trans('labels.routerDeleteMessage') }}</h2>
            </header>
            <p class='lead'>{{ trans('labels.deleteDeviceConfirm') }}</p>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.undo') }}</div>
                <div class="panel-body">
                    <p>{{ trans('labels.routerUndoMessage') }}</p>
                    <p><a class="btn btn-default" href="{{ route('router.index') }}"><span class='glyphicon glyphicon-arrow-left'></span> {{ trans('labels.routerGoBack') }}</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.delete') }}</div>
                <div class="panel-body">
                    <p>{{ trans('labels.routerDeleteMessageFinal') }}</p>
                    <p><a class="btn btn-danger" href="{{ route('router.destroy', ['serialNumber' => $router->serialNumber]) }}"><span class='glyphicon glyphicon-trash'></span> {{ trans('labels.delete') }}</a></p>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
