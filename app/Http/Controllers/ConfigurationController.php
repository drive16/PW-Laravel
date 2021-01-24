<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use NetworkConfigurator\DataLayer;
use Illuminate\Support\Facades\Redirect;

class ConfigurationController extends Controller {

    public function index() {
        
    }

    public function showRouter($serialNumber) {
        $dl = new DataLayer();
        $router = $dl->findRouterBySerial($serialNumber);
        $configuration = $dl->findConfigurationBySerial($serialNumber);

        return view('router.showConfig')->with('router', $router)->with('configuration', $configuration);
    }

    public function showSwitch($serialNumber) {
        $dl = new DataLayer();
        $switch = $dl->findSwitchBySerial($serialNumber);
        $configuration = $dl->findConfigurationBySerial($serialNumber);

        return view('switch.showConfig')->with('switch', $switch)->with('configuration', $configuration);
    }

    public function getRouterInterfaces($serialNumber) {

        $dl = new DataLayer();
        $model = $dl->getRouterModel($serialNumber);

        if ($model === 'Cisco 4331') {
            $interface = array(
                "GigabitEthernet0/0/0", "GigabitEthernet0/0/1", "GigabitEthernet0/0/2"
            );
            echo json_encode($interface);
            die();
        } else if($model === 'Cisco 2911') {
            $interface = array(
                "GigabitEthernet0/0", "GigabitEthernet0/1", "GigabitEthernet0/2"
            );
            echo json_encode($interface);
            die();
        } else {
            echo 'Error!';
        }
    }

}
