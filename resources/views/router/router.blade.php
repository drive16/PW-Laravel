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
        <div class="col-md-offset-10 col-xs-5">
            <p><a class="btn btn-default" href="{{ route('router.create') }}"><span class="glyphicon glyphicon-plus"></span> {{ trans('labels.routerInsert') }}</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="myTable" class="table table-striped table-hover table-responsive" style="width:100%">
                <col width="15%">
                <col width="15%">
                <col width="15%">
                <col width="35%">


                <thead>
                    <tr>
                        <th>{{ trans('labels.name') }}</th>
                        <th>{{ trans('labels.model') }}</th>
                        <th>{{ trans('labels.firmwareVersion') }}</th>
                        <th>Serial Number</th>
                        <th style="display: none"></th>
                        <th style="display: none"></th>
                        <th style="display: none"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($routers_list as $routers)
                    <tr>
                        <td> {{ $routers->name }} </td>
                        <td> {{ $routers->model }} </td>
                        <td> {{ $routers->firmware }} </td>
                        <td> {{ $routers->serialNumber }} </td>
                        @if(!isset($routers->configuration))
                        <td>
                            <a class="btn btn-default" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.showConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('router.edit', ['router' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.generateConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ route('router.destroy.confirm', ['serialNumber' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @else
                        <td>
                            <a class="btn btn-default" href="{{ route('router.config', ['serialNumber' => $routers->serialNumber]) }}"><span></span> {{ trans('labels.showConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('router.delete.configuration', ['serialNumber' => $routers->serialNumber]) }}"><span></span> {{ trans('labels.deleteConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" disabled="disabled" href="{{ route('router.destroy.confirm', ['serialNumber' => $routers->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection