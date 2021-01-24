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
        <div class="col-md-offset-10 col-xs-5">
            <p>
                <a class="btn btn-default" href="{{ route('switch.create') }}"><span class="glyphicon glyphicon-plus"></span> {{ trans('labels.switchInsert') }}</a>
            </p>
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
                    @foreach($switches_list as $switches)
                    <tr>
                        <td> {{ $switches->name }} </td>
                        <td> {{ $switches->model }} </td>
                        <td> {{ $switches->firmware }} </td>
                        <td> {{ $switches->serialNumber }} </td>
                        @if(!isset($switches->configuration))
                        <td>
                            <a class="btn btn-default" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.showConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('switch.edit', ['switch' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.generateConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @else
                        <td>
                            <a class="btn btn-default" href="{{ route('switch.config', ['serialNumber' => $switches->serialNumber]) }}"><span></span> {{ trans('labels.showConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('switch.delete.configuration', ['serialNumber' => $switches->serialNumber]) }}"><span></span> {{ trans('labels.deleteConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" disabled="disabled" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
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