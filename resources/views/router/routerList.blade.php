@extends('layouts.master')

@section('titolo')
{{ trans('labels.routerTitle') }}
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
@endsection

@section('corpo')        
<div class="container">
    <div class="row">
        <div class="col-md-12 right">
            <p><a class="btn btn-default right" href="{{ route('router.index') }}"> {{ trans('labels.changeVisualization') }} </a></p><br><br>
            <p><a class="btn btn-default right" href="{{ route('router.create') }}"><span class="glyphicon glyphicon-plus"></span> {{ trans('labels.routerInsert') }}</a></p><br><br>
            <form  class="right" method="post" action="{{ route('router.keyword') }}">
                @csrf
                <input class="form-control rounded-pill mr-1 pr-5" type="text" name="keyword">
                <input type="submit" name="submit" class="btn" value="{{ trans('labels.search') }}">
            </form>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12" align="center">
            @foreach($routers_list as $routers)
            <div class="panel panel-default">
                @if($routers->model === 'Cisco 2911')
                <img src="/img/2900.jpg" width="200px" height="100px">
                @elseif($routers->model === 'Cisco 4331')
                <img src="/img/isr4000.jpg" width="200px" height="100px">
                @endif
                <div class="panel-heading">
                    <h4 class="panel-title">{{ $routers->name }}</h4>
                    <p class="panel-text">{{ $routers->model }} - SN: {{ $routers->serialNumber }}</p>
                </div>
                <div class="panel-body">
                    @if(!isset($routers->configuration))
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationAbsent') }}">
                        <a class="btn btn-default w-100" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.showConfiguration') }}</a>
                    </span>
                    <a class="btn btn-primary w-100" href="{{ route('router.edit', ['router' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.generateConfiguration') }}</a>
                    <a class="btn btn-danger w-100" href="{{ route('router.destroy.confirm', ['serialNumber' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                    @else
                    <a class="btn btn-default w-100" href="{{ route('router.config', ['serialNumber' => $routers->serialNumber]) }}"><span></span> {{ trans('labels.showConfiguration') }}</a>
                    <a class="btn btn-warning w-100" href="{{ route('router.delete.configuration', ['serialNumber' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.deleteConfiguration') }}</a>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationPresent') }}">
                        <a class="btn btn-danger w-100" disabled="disabled" href="{{ route('router.destroy.confirm', ['serialNumber' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

