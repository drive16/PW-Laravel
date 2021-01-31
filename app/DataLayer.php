<?php

namespace NetworkConfigurator;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use NetworkConfigurator\Configuration;
use NetworkConfigurator\SwitchConfiguration;
use NetworkConfigurator\Router;
use NetworkConfigurator\Switches;
use NetworkConfigurator\User;

class DataLayer extends Model {

    public function listRouters($user) {
        return Router::where('userID', $user)->orderBy('name', 'asc')->get();
    }

    public function listSwitches($user) {
        return Switches::where('userID', $user)->orderBy('name', 'asc')->get();
    }

    public function findRouterBySerial($serial) {
        return Router::find($serial);
    }

    public function findSwitchBySerial($serial) {
        return Switches::find($serial);
    }

    public function editRouter($name, $model, $firmware, $ports, $serialNumber) {
        $router = Router::find($serialNumber);
        $router->name = $name;
        $router->model = $model;
        $router->firmware = $firmware;
        $router->ports = $ports;
        $router->save();
    }

    public function editSwitch($name, $model, $firmware, $ports, $serialNumber) {
        $switch = Switches::find($serialNumber);
        $switch->name = $name;
        $switch->model = $model;
        $switch->firmware = $firmware;
        $switch->ports = $ports;
        $switch->save();
    }

    public function addRouter($name, $model, $firmware, $ports, $serialNumber, $user) {
        $router = new Router;
        $router->name = $name;
        $router->model = $model;
        $router->firmware = $firmware;
        $router->ports = $ports;
        $router->serialNumber = $serialNumber;
        $router->userID = $user;
        $router->save();
    }

    public function addSwitch($name, $model, $firmware, $ports, $serialNumber, $user) {
        $switch = new Switches;
        $switch->name = $name;
        $switch->model = $model;
        $switch->firmware = $firmware;
        $switch->ports = $ports;
        $switch->serialNumber = $serialNumber;
        $switch->userID = $user;
        $switch->save();
    }

    public function deleteRouter($serialNumber) {
        Router::find($serialNumber)->delete();
    }

    public function deleteSwitch($serialNumber) {
        Switches::find($serialNumber)->delete();
    }

    public function addConfiguration($hostname, $username, $password, $domainName, $interface, $ipAddress, $subnetMask, $gateway, $serialNumber) {
        $configuration = new Configuration;
        $configuration->hostname = $hostname;
        $configuration->username = $username;
        $configuration->password = md5($password);
        $configuration->domainName = $domainName;
        $configuration->interface = $interface;
        $configuration->ipAddress = $ipAddress;
        $configuration->subnetMask = $subnetMask;
        $configuration->gateway = $gateway;
        $configuration->deviceID = $serialNumber;
        $configuration->save();
    }

    public function addSwitchConfiguration($hostname, $username, $password, $domainName, $interface, $ipAddress, $subnetMask, $gateway, $serialNumber) {
        $configuration = new SwitchConfiguration;
        $configuration->hostname = $hostname;
        $configuration->username = $username;
        $configuration->password = md5($password);
        $configuration->domainName = $domainName;
        $configuration->interface = $interface;
        $configuration->ipAddress = $ipAddress;
        $configuration->subnetMask = $subnetMask;
        $configuration->gateway = $gateway;
        $configuration->deviceID = $serialNumber;
        $configuration->save();
    }

    public function deleteConfiguration($serialNumber) {
        if (Router::find($serialNumber)) { //Se voglio rimuovere la configurazione di un router
            Configuration::where('deviceID', $serialNumber)->delete();
        } else {
            SwitchConfiguration::where('deviceID', $serialNumber)->delete();
        }
    }

    public function findConfigurationBySerial($serial) {
        if (Router::find($serial)) { //se sto cercando la configurazione di un router
            $configuration = Configuration::where('deviceID', $serial)->get();
        } else { // se sto cercando la configurazione di uno switch
            $configuration = SwitchConfiguration::where('deviceID', $serial)->get();
        }

        if (count($configuration) != 0) {
            return $configuration[0]; //ritorna il primo (e unico) elemento della Collection ottenuta da get()
        } else {
            return null;
        }
    }

    public function getUserID($email) {
        $users = User::where('email', $email)->get(['id']);
        return $users[0]->id;
    }
    
    public function getRouterModel($serialNumber) {
        $router = $this->findRouterBySerial($serialNumber);
        return $router->model;
    }
    
    public function searchSwitches($keyword, $user) {
        $switches_list = $this->listSwitches($user);
        
        $match = array();
        foreach ($switches_list as $switches) {
            if(strpos($switches->name, $keyword) !== false || strpos($switches->serialNumber, $keyword) !== false) {
                $match[] = $switches;
            }
        }
        
        return $match;
    }
    
    public function searchRouters($keyword, $user) {
        $routers_list = $this->listRouters($user);
        
        $match = array();
        foreach ($routers_list as $routers) {
            if(strpos($routers->name, $keyword) !== false || strpos($routers->serialNumber, $keyword) !== false) {
                $match[] = $routers;
            }
        }
        
        return $match;
    }


}
