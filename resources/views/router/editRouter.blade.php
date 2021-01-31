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
<li class="active"><a href="{{  route('router.index') }}">Routers</a></li>
<li class="active">{{ trans('labels.addRouter') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" name="router" method="post" action="{{  route('router.store') }}">
                @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-3">{{ trans('labels.name') }}</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name" placeholder="{{ trans('labels.routerName') }}">
                            <span class="invalid-input" id="invalid-name"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="model" class="col-md-3">{{ trans('labels.model') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="model" name="model"><option selected>{{ trans('labels.model') }}</option><option>Cisco 4331</option><option>Cisco 2911</option></select>
                            <span class="invalid-input" id="select-model"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="firmware" class="col-md-3">Firmware</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="firmware" name="firmware" placeholder="{{ trans('labels.routerFirmware') }}">
                            <span class="invalid-input" id="invalid-firmware"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="ports" class="col-md-3">{{ trans('labels.ports') }}</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="ports" name="ports" placeholder="{{ trans('labels.routerPorts') }}">
                            <span class="invalid-input" id="select-ports"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="serialNumber" class="col-md-3">Serial Number</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="serialNumber" name="serialNumber" placeholder="{{ trans('labels.routerSN') }}">
                            <span class="invalid-input" id="invalid-SN"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-save"></span> {{ trans('labels.add') }}</label>
                            <input id="mySubmit" type="submit" value="Create" class="hidden" onclick="event.preventDefault(); checkAddDevice(this);"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="{{ route('router.index') }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.cancel') }}</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection

