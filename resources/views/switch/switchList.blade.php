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
@endsection

@section('corpo')        
<div class="container">
    <div class="row">
        <div class="col-md-12 right">
            <p><a class="btn btn-default right" href="{{ route('switch.index') }}"> {{ trans('labels.changeVisualization') }} </a></p><br><br>
            <p><a class="btn btn-default right" href="{{ route('switch.create') }}"><span class="glyphicon glyphicon-plus"></span> {{ trans('labels.switchInsert') }}</a></p><br><br>
            <form class="right" method="post" action="{{ route('switch.keyword') }}">
                @csrf
                <input class="form-control rounded-pill mr-1 pr-5" type="text" name="keyword">
                <input type="submit" name="submit" class="btn btn-default" value="{{ trans('labels.search') }}">
            </form>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12" align="center">
            @foreach($switches_list as $switches)
            <div class="panel panel-default">
                @if($switches->model === 'C2960-X')
                <img src="/img/c2960-x.jpeg" width="200px" height="100px">
                @elseif($switches->model === 'C2960-S')
                <img src="/img/c2960-s.jpg" width="200px" height="100px">
                @endif
                <div class="panel-heading">
                    <h4 class="panel-title">{{ $switches->name }}</h4>
                    <p class="panel-text">{{ $switches->model }} - SN: {{ $switches->serialNumber }}</p>
                </div>
                <div class="panel-body">
                    @if(!isset($switches->configuration))
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationAbsent') }}">
                        <a class="btn btn-default w-100" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.showConfiguration') }}</a>
                    </span>
                    <a class="btn btn-primary w-100" href="{{ route('switch.edit', ['switch' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.generateConfiguration') }}</a>
                    <a class="btn btn-danger w-100" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                    @else
                    <a class="btn btn-default w-100" href="{{ route('switch.config', ['serialNumber' => $switches->serialNumber]) }}"><span></span> {{ trans('labels.showConfiguration') }}</a>
                    <a class="btn btn-warning w-100" href="{{ route('switch.delete.configuration', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.deleteConfiguration') }}</a>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationPresent') }}">
                        <a class="btn btn-danger w-100" disabled="disabled" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


