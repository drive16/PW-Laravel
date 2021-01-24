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
<li class="active"><a href="{{  route('switch.index') }}">Switches</a></li>
<li class="active">{{ trans('labels.addSwitch') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" name="switch" method="post" action="{{ route('switch.store') }}">
                @csrf
                    <div class="form-group">
                        <label for="name" class="col-md-3">{{ trans('labels.name') }}</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="name" name="name" placeholder="{{ trans('labels.switchName') }}">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="model" class="col-md-3">{{ trans('labels.model') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="model" name="model"><option selected>{{ trans('labels.model') }}</option><option>C2960-X</option><option>C2960-S</option></select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="firmware" class="col-md-3">Firmware</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="firmware" name="firmware" placeholder="{{ trans('labels.switchFirmware') }}">
                            <span class="invalid-input" id="invalid-firmware"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label for="ports" class="col-md-3">{{ trans('labels.ports') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ports" name="ports"><option selected>24</option><option>48</option></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="serialNumber" class="col-md-3">Serial Number</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="serialNumber" name="serialNumber" placeholder="{{ trans('labels.switchSN') }}">
                            <span class="invalid-input" id="invalid-SN"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-save"></span> {{ trans('labels.add') }}</label>
                            <input id="mySubmit" type="submit" value="Create" class="hidden" onclick="event.preventDefault(); checkFirmware(this); checkSN(this);"/>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <a href="{{ route('switch.index') }}" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-remove"></span> {{ trans('labels.cancel') }}</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection

