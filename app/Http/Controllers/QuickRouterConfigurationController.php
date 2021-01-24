<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuickRouterConfigurationController extends Controller {

    public function index() {
        return view('routerConfiguration.routerConfiguration');
    }

    public function store(Request $request) {

        $ports = $request->input('ports');
        $interface = $request->input('interface');
        $speed = $request->input('speed');
        $duplex = $request->input('duplex');
        $ipAddress = $request->input('ipAddress');
        $subnetMask = $request->input('subnetmask');
        $routingprotocol = $request->input('routingprotocol');
        $network = $request->input('network');
        $area = $request->input('area');

        return view('routerConfiguration.quickConfiguration')->with('ports', $ports)->with('interface', $interface)->with('speed', $speed)->with('duplex', $duplex)->with('ipAddress', $ipAddress)->with('subnetmask', $subnetMask)
                        ->with('routingprotocol', $routingprotocol)->with('network', $network)->with('area', $area);
    }

    public function getRouterInterface(Request $request) {

        $ports = $request->input('ports');
        $ports_number = (int) $ports;
        $interface = array();

        if ($ports_number === 3) {

            for ($i = 1; $i <= $ports_number; $i++) {
                $interface = Arr::add($interface, $i, "GigabitEthernet0/0/" . trim($i));
            }

            echo json_encode($interface);
            die();
        } else if ($ports_number === 4) {

            for ($i = 1; $i <= $ports_number; $i++) {
                $interface = Arr::add($interface, $i, "GigabitEthernet0/0/" . trim($i));
            }

            echo json_encode($interface);
            die();
        } else {
            echo 'Error!';
        }
    }

}
