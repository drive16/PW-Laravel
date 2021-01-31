@extends('layouts.master')

@section('titolo')
{{ trans('labels.generateConfigurationRouterTitle') }}
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
<li class="active">{{ trans('labels.generateConfiguration') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(isset($router->serialNumber))
            <form class="form-horizontal" name="router" method="post" action="{{  route('router.update', ['serialNumber' => $router->serialNumber]) }}">
                @else
                <form class="form-horizontal" name="router" method="post" action="{{  route('router.store') }}">
                    @endif
                    @csrf

                    <div class="form-group">
                        <label for="model" class="col-md-3">{{ trans('labels.model') }}</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-plaintext" type="text" readonly id="model" name="model" value="{{  $router->model }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="serialNumber" class="col-md-3">Serial Number</label>
                        <div class="col-sm-9">
                            <input class="form-control form-control-plaintext" type="text" readonly id="serialNumber" name="serialNumber" value="{{  $router->serialNumber }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hostname" class="col-md-3">Hostname</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="hostname" name="hostname" placeholder="{{ trans('labels.routerHostname') }}">
                            <span class="invalid-input" id="invalid-hostname"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-md-3">Username</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="username" name="username" placeholder="Username">
                            <span class="invalid-input" id="invalid-username"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                            <span class="invalid-input" id="invalid-password"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="domainName" class="col-md-3">{{ trans('labels.domainName') }}</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="domainName" name="domainName" placeholder="{{ trans('labels.domainName') }}">
                            <span class="invalid-input" id="invalid-domainName"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="interface" class="col-md-3">{{ trans('labels.interface') }}</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="interface" name="interface" onchange="getInt();"><option value="" selected data-default>{{ trans('labels.selectInterface') }}</option></select>
                        </div>
                        <script>
                            function getInt() {
                                var interface = document.getElementById("interface").value;
                                if (interface === "") {
                                    document.getElementById("ipaddress-form").style.display = "none";
                                    document.getElementById("subnetmask-form").style.display = "none";
                                } else {
                                    document.getElementById("ipaddress-form").style.display = "";
                                    document.getElementById("subnetmask-form").style.display = "";
                                    document.getElementById("ipAddress").innerHTML = interface + " IP address";
                                    document.getElementById("subnetMask").innerHTML = interface + " subnet mask";
                                }
                            }
                        </script>
                    </div>

                    <script>
                        //$('#interface').empty();
                        var serialNumber = document.getElementById("serialNumber").value;
                        var dropDown = document.getElementById("interface");
                        var interface = dropDown.options[dropDown.selectedIndex].value;

                        $(document).ready(function () {
                            $.ajax({
                                type: 'GET',
                                url: '/routerInterfaces/' + serialNumber,
                                data: {'interface': interface},
                                success: function (data) {
                                    var opts = $.parseJSON(data);
                                    $.each(opts, function (i, d) {
                                        console.log(d); // per vedere cosa ottengo
                                        $('#interface').append('<option value="' + d + '">' + d + '</option>');
                                    })
                                }
                            });
                        })
                    </script>

                    <div class="form-group" id="ipaddress-form" style="display: none">
                        <label for="int-ip-address" class="col-md-3" id="ipAddress"></label>
                        <div class="col-sm-9">
                            <input class="form-control" id="ipAddress" name="int-ip-address">
                            <span class="invalid-input" id="invalid-ipAddress"></span>
                        </div>
                    </div>

                    <div class="form-group" id="subnetmask-form" style="display: none">
                        <label for="subnetmask-form" class="col-md-3" id="subnetMask"></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="subnetMask" name="subnetMask"><option>255.0.0.0</option><option>255.255.0.0</option><option selected data-default>255.255.255.0</option><option>255.255.255.128</option><option>255.255.255.192</option><option>255.255.255.224</option><option>255.255.255.240</option><option>255.255.255.248</option><option>255.255.255.252</option><option>255.255.255.254</option></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gateway" class="col-md-3">Gateway</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" id="gateway" name="gateway" placeholder="Default Gateway">
                            <span class="invalid-input" id="invalid-gateway"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-9 col-sm-offset-3">
                            <input type="hidden" name="id" value="{{  $router->serialNumber }}"/>
                            <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-save"></span> {{ trans('labels.generate') }}</label>
                            <input id="mySubmit" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkDeviceFields(this);"/>
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
