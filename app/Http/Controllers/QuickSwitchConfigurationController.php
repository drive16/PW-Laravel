<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuickSwitchConfigurationController extends Controller {

    public function index() {
        return view('switchConfiguration.switchConfiguration');
    }

    public function store(Request $request) {

        $ports = $request->input('ports');
        $interface = $request->input('interface');
        $speed = $request->input('speed');
        $duplex = $request->input('duplex');
        $portfast = $request->input('portfast');
        $bpduguard = $request->input('bpduguard');
        $switchport = $request->input('switchport');
        $vlan = $request->input('vlan');
        $spanningtree = $request->input('spanningtree');
        $priority = $request->input('priority');
        $routingprotocol = $request->input('routingprotocol');
        $network = $request->input('network');
        $area = $request->input('area');

        return view('switchConfiguration.quickConfiguration')->with('ports', $ports)->with('interface', $interface)->with('speed', $speed)->with('duplex', $duplex)->with('portfast', $portfast)->with('bpduguard', $bpduguard)->with('switchport', $switchport)->with('vlan', $vlan)
                ->with('spanningtree', $spanningtree)->with('priority', $priority)
                ->with('routingprotocol', $routingprotocol)->with('network', $network)->with('area', $area);
    }

    public function getSwitchInterfaces(Request $request) {

        $ports = $request->input('ports');
        $ports_number = (int) $ports;
        $interface = array();

        if ($ports_number === 24) {

            for ($i = 1; $i <= $ports_number; $i++) {
                $interface = Arr::add($interface, $i, "GigabitEthernet1/0/" . trim($i));
            }

            echo json_encode($interface);
            die();
        } else if ($ports_number === 48) {

            for ($i = 1; $i <= $ports_number; $i++) {
                $interface = Arr::add($interface, $i, "GigabitEthernet1/0/" . trim($i));
            }

            echo json_encode($interface);
            die();
        } else {
            echo 'Error!';
        }
    }

}
