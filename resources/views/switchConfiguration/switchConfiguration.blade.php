@extends('layouts.master')

@section('titolo')
{{ trans('labels.switchQuickConfiguration') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li><a href="{{ route('router.index') }}">Routers</a></li>
<li><a href="{{ route('switch.index') }}">Switches</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.quickConfiguration') }}<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('routerConfiguration.index') }}">Router</a></li>
        <li class="active"><a href="{{ route('switchConfiguration.index') }}">Switch</a></li>
    </ul>
</li>
@endsection

@section('breadcrumb')
<li><a href="{{ route('home') }}">Home</a></li>
<li class="active">{{ trans('labels.quickConfiguration') }}</li>
<li class="active">{{ trans('labels.switchQuickConfiguration') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group w3-ul w3-hoverable" id="configuration-section">
                <li tabindex="0" class="list-group-item" id="interface-form" onclick="configurationForm(this.id)">{{ trans('labels.interface') }}</li>  <!--tabindex viene usato per rendere l'elemento li focusabile-->
                <li tabindex="0" class="list-group-item" id="stp-form" onclick="configurationForm(this.id)">Spanning Tree Protocol</li>
                <li tabindex="0" class="list-group-item" id="routing-form" onclick="configurationForm(this.id)">{{ trans('labels.routingProtocol') }}</li>
            </ul>
        </div>
        <div class="col-md-9">
            <form class="form-horizontal" id="quickConfigurationForm" method="post" action="{{ route('switchConfiguration.store') }}">
                @csrf
                <div class="form-group" id="ports-selection" style="display: none">
                    <label for="ports" class="col-md-3">{{ trans('labels.ports') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="ports" name="ports"><option value="" selected data-default>{{ trans('labels.selectInterfaceNumber') }}</option><option value="24">24</option><option value="48">48</option></select>
                    </div>
                </div>

                <div class="form-group" id="interface-configuration" style="display: none">
                    <label for="interface" class="col-md-3">{{ trans('labels.interface') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="interface" name="interface"><option value="" selected data-default>{{ trans('labels.selectInterface') }}</option></select> 
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

                <div class="form-group" id="portfast-configuration" style="display: none" onclick="showBPDU();">
                    <label for="portfast" class="col-md-3">Portfast</label>
                    <input type="checkbox" class="form-check-input col-xs-9" id="portfast" name="portfast">
                </div>

                <div class="form-group" id="bpduguard-configuration" style="display: none">
                    <label for="bpduguard" class="col-md-3">BPDU Guard</label>
                    <input type="checkbox" class="form-check-input col-xs-9" id="bpduguard" name="bpduguard">
                </div>

                <div class="form-group" id="switchport-configuration" style="display: none" onclick="showVLAN();">
                    <label for="switchport" class="col-md-3">Switchport Mode</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="switchport" name="switchport"><option value="" selected data-default>{{ trans('labels.selectSwitchport') }}</option><option value="access">Access</option><option value="trunk">Trunk</option></select>
                    </div>
                </div>

                <div class="form-group" id="vlan-configuration" style="display: none">
                    <label for="vlan" class="col-md-3">VLAN</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="vlan" name="vlan"><option value="" selected data-default>{{ trans('labels.selectVLAN') }}</option></select>
                    </div>
                </div>

                <div class="form-group" id="spanning-tree-configuration" style="display: none">
                    <label for="spanningtree" class="col-md-3">{{ trans('labels.STPVersion') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="spanningtree" name="spanningtree"><option value="" selected data-default>{{ trans('labels.selectSTPVersion') }}</option><option value="pvst">Per-VLAN Spanning Tree</option><option value="pvst+">Per-VLAN Spanning Tree Plus</option><option value="rstp">Rapid Spanning Tree</option><option value="mst">Multiple Spanning Tree</option></select>
                    </div>
                </div>

                <div class="form-group" id="priority-configuration" style="display: none">
                    <label for="priority" class="col-md-3">Priority</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="priority" name="priority"><option value="" selected data-default>{{ trans('labels.selectSTPPriority') }}</option></select>
                    </div>
                </div>

                <div class="form-group" id="routing-configuration" style="display: none" onclick="showOSPF()">
                    <label for="routingprotocol" class="col-md-3">{{ trans('labels.routingProtocol') }}</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="routingprotocol" name="routingprotocol"><option value="" selected data-default>{{ trans('labels.selectRouting') }}</option><option value="ospf">OSPF</option></select>
                    </div>
                </div>

                <div class="form-group" id="network-configuration" style="display: none">
                    <label for="network" class="col-md-3">Network</label>
                    <div class="col-xs-9">
                        <input class="form-control" type="text" id="network" name="network" placeholder="Network">
                        <span class="invalid-input" id="invalid-network"></span>
                    </div>
                </div>

                <div class="form-group" id="area-configuration" style="display: none">
                    <label for="area" class="col-md-3">Area</label>
                    <div class="col-xs-9">
                        <select class="form-control" id="area" name="area"><option value="" selected data-default>{{ trans('labels.selectArea') }}</option></select>
                    </div>
                </div>

                <div class="form-group" id="subnetmask-configuration" style="display: none">
                    <label for="subnetmask" class="col-md-3">Subnet Mask</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="subnetmask" name="subnetmask"><option value="0.255.255.255">255.0.0.0</option><option value="0.0.255.255">255.255.0.0</option><option value="0.0.0.255" selected data-default>255.255.255.0</option></select>  
                    </div>
                </div>

                <div class="form-group" id="interfaceButton" style="display: none">
                    <div class="col-sm-9 col-sm-offset-3">
                        <label for="interfaceConfigButton" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-download"></span> {{ trans('labels.quickConfigButton') }}</label>
                        <input id="interfaceConfigButton" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkSwitchInterfaceQuickConfiguration(this);"/>
                    </div>
                </div>

                <div class="form-group" id="spanningButton" style="display: none">
                    <div class="col-sm-9 col-sm-offset-3">
                        <label for="spanningConfigButton" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-download"></span> {{ trans('labels.quickConfigButton') }}</label>
                        <input id="spanningConfigButton" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkSpanningQuickConfiguration(this);"/>
                    </div>
                </div>

                <div class="form-group" id="routingButton" style="display: none">
                    <div class="col-sm-9 col-sm-offset-3">
                        <label for="routingConfigButton" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-download"></span> {{ trans('labels.quickConfigButton') }}</label>
                        <input id="routingConfigButton" type="submit" value="Generate" class="hidden" onclick="event.preventDefault(); checkRoutingQuickConfiguration(this);"/>
                    </div>
                </div>

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="guido.garolla@gmail.com">
                    <input type="hidden" name="lc" value="US">
                    <input type="hidden" name="item_name" value="Configurazione rapida">
                    <input type="hidden" name="amount" value="2.00">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="button_subtype" value="services">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

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
                url: '/switchInterfaces/' + ports,
                data: {'ports': ports},
                success: function (data) {
                    var opts = $.parseJSON(data);
                    $.each(opts, function (i, d) {
                        $('#interface').append('<option value="' + d + '">' + d + '</option>');
                    });
                }
            });
        });

        $('#priority').ready(function () {
            for (var i = 0; i <= 61440; i += 4096) {
                $('#priority').append('<option value="' + i + '">' + i + '</option>');
            }
        });

        $('#vlan').ready(function () {
            for (var i = 1; i <= 4094; i++) {
                $('#vlan').append('<option value="' + i + '">' + i + '</option>');
            }
        });

        $('#area').ready(function () {
            for (var i = 0; i <= 255; i++) {
                $('#area').append('<option value="' + i + '">' + i + '</option>');
            }
        });
    </script>
</div>
@endsection