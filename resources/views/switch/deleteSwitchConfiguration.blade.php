@extends('layouts.master')

@section('titolo')
{{ trans('labels.switchTitle') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li><a href="{{ route('router.index') }}">Routers</a></li>
<li class="active"><a href="{{ route('switch.index') }}">Switches</a></li>
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
<li class="active">Switches</li>
<li class="active">{{ trans('labels.deleteConfiguration') }}</li>
@endsection

@section('corpo')
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            <header>
                <h2>{{ trans('labels.configurationDeleteMessage') }}</h2>
            </header>
            <p class='lead'>{{ trans('labels.configurationDeleteMessageFinal') }}</p>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.undo') }}</div>
                <div class="panel-body">
                    <p>{{ trans('labels.configurationUndoMessage') }}</p>
                    <p><a class="btn btn-default" href="{{ route('switch.index') }}"><span class='glyphicon glyphicon-arrow-left'></span> {{ trans('labels.switchGoBack') }}</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('labels.delete') }}</div>
                <div class="panel-body">
                    <p>{{ trans('labels.configurationDeleteMessage') }}</p>
                    <p><a class="btn btn-danger" href="{{ route('switch.deleteConfiguration', ['serialNumber' => $switch->serialNumber]) }}"><span class='glyphicon glyphicon-trash'></span> {{ trans('labels.delete') }}</a></p>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection

