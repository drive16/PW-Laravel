@extends('layouts.master')

@section('titolo')
{{ trans('labels.routerQuickConfiguration') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li><a href="{{ route('router.index') }}">Routers</a></li>
<li><a href="{{ route('switch.index') }}">Switches</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.quickConfiguration') }}<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="active"><a href="{{ route('routerConfiguration.index') }}">Router</a></li>
        <li><a href="{{ route('switchConfiguration.index') }}">Switch</a></li>
    </ul>
</li>
@endsection

@section('breadcrumb')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active">{{ trans('labels.quickConfiguration') }}</li>
<li class="active">{{ trans('labels.routerQuickConfiguration') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group w3-ul w3-hoverable" id="configuration-section">
                <li tabindex="0" class="list-group-item" id="interface-form" onclick="routerConfigurationForm(this.id)">{{ trans('labels.interface') }}</li>  <!--tabindex viene usato per rendere l'elemento li focusabile-->
                <li tabindex="0" class="list-group-item" id="routing-form" onclick="routerConfigurationForm(this.id)">{{ trans('labels.routingProtocol') }}</li>
            </ul>
        </div>
        <div class="col-md-9">
            <form class="form-horizontal" id="quickConfigurationForm" method="post" action="{{ route('routerConfiguration.store') }}">
                @csrf
                <div class="form-group" id="ports-selection" style="display: none">
                    <label for="ports" class="col-md-3">{{ trans('labels.ports') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="ports" name="ports"><option value="" selected data-default>{{ trans('labels.selectInterfaceNumber') }}</option><option value="3">3</option><option value="4">4</option></select>
                    </div>
                </div>

                <div class="form-group" id="interface-configuration" style="display: none">
                    <label for="interface" class="col-md-3">{{ trans('labels.interface') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="interface" name="interface"><option value="" selected data-default>{{ trans('labels.selectInterface') }}</option></select> 
                    </div>
                </div>

                <div class="form-group" id="address-configuration" style="display: none">
                    <label for="ipAddress" class="col-md-3">{{ trans('labels.ipAddress') }}</label>
                    <div class="col-xs-9">
                        <input class="form-control" id="ipAddress" name="ipAddress">
                        <span class="invalid-input" id="invalid-ipAddress"></span>
                    </div>
                </div>

                <div class="form-group" id="subnetmask-configuration" style="display: none">
                    <label for="subnetmask" class="col-md-3">Subnet Mask</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="subnetmask" name="subnetmask"><option value="" selected data-default>{{ trans('labels.selectSubnet') }}</option><option>255.0.0.0</option><option>255.255.0.0</option><option>255.255.255.0</option><option>255.255.255.128</option><option>255.255.255.192</option><option>255.255.255.224</option><option>255.255.255.240</option><option>255.255.255.248</option><option>255.255.255.252</option><option>255.255.255.254</option></select>
                    </div>
                </div>

                <div class="form-group" id="speed-configuration" style="display: none" onchange="showDuplexSetting();">
                    <label for="speed" class="col-md-3">{{ trans('labels.speed') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="speed" name="speed"><option value="" selected data-default>{{ trans('labels.selectSpeed') }}</option><option value="10">10</option><option value="100">100</option><option value="1000">1000</option><option value="auto">Auto</option></select>
                    </div>
                </div>

                <div class="form-group" id="duplex-configuration" style="display: none">
                    <label for="duplex" class="col-md-3">Duplex</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="duplex" name="duplex"><option value="" selected data-default>{{ trans('labels.selectDuplex') }}</option></select>
                    </div>
                </div>

                <div class="form-group" id="routing-configuration" style="display: none" onclick="showRouting()">
                    <label for="routingprotocol" class="col-md-3">{{ trans('labels.routingProtocol') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="routingprotocol" name="routingprotocol"><option value="" selected data-default>{{ trans('labels.selectRouting') }}</option><option value="ospf">OSPF</option></select>
                    </div>
                </div>

                <div class="form-group" id="area-configuration" style="display: none">
                    <label for="area" class="col-md-3">Area</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="area" name="area"><option value="" selected data-default>{{ trans('labels.selectArea') }}</option></select>
                    </div>
                </div>

                <div class="form-group" id="network-configuration" style="display: none">
                    <label for="network" class="col-md-3">Network</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="network" name="network" placeholder="Network">  
                        <span class="invalid-input" id="invalid-network"></span>
                    </div>
                </div>

                <div class="form-group" id="interfaceButton" style="display: none">
                    <div class="col-sm-9 col-sm-offset-3">
                        <label for="interfaceConfigButton" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-download"></span> {{ trans('labels.quickConfigButton') }}</label>
                        <input id="interfaceConfigButton" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkInterfaceQuickConfiguration(this);"/>
                    </div>
                </div>

                <div class="form-group" id="routingButton" style="display: none">
                    <div class="col-sm-9 col-sm-offset-3">
                        <label for="routingConfigButton" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-download"></span> {{ trans('labels.quickConfigButton') }}</label>
                        <input id="routingConfigButton" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkRoutingQuickConfiguration(this);"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('li').click(function () {
            $('.highlight').removeClass('highlight');
            $(this).addClass('highlight');
        });

        var dropDown = document.getElementById('interface');
        var interface = dropDown.options[dropDown.selectedIndex].value;

        $('#ports').change(function () {
            $('#interface').empty();
            var ports = document.getElementById('ports').value;
            $.ajax({
                type: 'GET',
                url: '/routerInterface/' + ports,
                data: {'ports': ports},
                success: function (data) {
                    var opts = $.parseJSON(data);
                    $.each(opts, function (i, d) {
                        $('#interface').append('<option value="' + d + '">' + d + '</option>');
                    });
                }
            });
        });

        $('#area').ready(function () {
            for (var i = 0; i <= 255; i++) {
                $('#area').append('<option value="' + i + '">' + i + '</option>');
            }
        });
    </script>
</div>
@endsection
