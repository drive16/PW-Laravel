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
            <p><a class="btn btn-default" href="{{ route('switch.list') }}"> {{ trans('labels.changeVisualization') }} </a></p>
            <p><a class="btn btn-default" href="{{ route('switch.create') }}"><span class="glyphicon glyphicon-plus"></span> {{ trans('labels.switchInsert') }}</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="myTable" class="table table-striped table-hover table-responsive" style="width:100%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="15%">
                <col width="15%">

                <thead>
                    <tr>
                        <th>{{ trans('labels.image') }}</th>
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
                        @if($switches->model === 'C2960-X')
                        <td>
                            <img id="<?php echo trim($switches['model'], ";"); ?>" src="/img/c2960-x.jpeg">
                        </td>
                        @elseif($switches->model === 'C2960-S')
                        <td>
                            <img id="<?php echo trim($switches['model'], ";"); ?>" src="/img/c2960-s.jpg">
                        </td>
                        @endif
                        <td> {{ $switches->name }} </td>
                        <td> {{ $switches->model }} </td>
                        <td> {{ $switches->firmware }} </td>
                        <td> {{ $switches->serialNumber }} </td>
                        @if(!isset($switches->configuration))
                        <td>
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationAbsent') }}">
                                <a class="btn btn-default w-100" disabled="disabled" href=""><span class="glyphicon glyphicon-ban-circle"></span> {{ trans('labels.showConfiguration') }}</a>
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-primary w-100" href="{{ route('switch.edit', ['switch' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-pencil"></span> {{ trans('labels.generateConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger w-100" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                        </td>
                        @else
                        <td>
                            <a class="btn btn-default w-100" href="{{ route('switch.config', ['serialNumber' => $switches->serialNumber]) }}"><span></span> {{ trans('labels.showConfiguration') }}</a>
                        </td>
                        <td>
                            <a class="btn btn-warning w-100" href="{{ route('switch.delete.configuration', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.deleteConfiguration') }}</a>
                        </td>
                        <td>
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('labels.configurationPresent') }}">
                                <a class="btn btn-danger w-100" disabled="disabled" href="{{ route('switch.destroy.confirm', ['serialNumber' => $switches->serialNumber]) }}"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.delete') }}</a>
                            </span>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
<!--            <script>
                $('document').ready(function () {
                    var switches = <?php echo json_encode($switches_list) ?>;
                    for(var i = 0; i < switches.length; i++) {
                        var testing = document.createElement('p');
                        testing.innerHTML = 'Prova';
                        document.getElementById('C2960-X;').appendChild(testing);
                    }
                    if (switches["model"] === "C2960-X;") {
                        var testing = document.createElement('p');
                        testing.innerHTML = 'Prova';
                        document.getElementById('test').appendChild(testing);
                    } else if (switches["model"] === "C2960-S;") {

                    }
                });
            </script>-->
        </div>
    </div>
</div>
@endsection