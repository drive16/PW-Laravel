<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use NetworkConfigurator\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller {

    public function index() {

        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $routers_list = $dl->listRouters($userID);

        return view('router.router')->with('routers_list', $routers_list);
    }

    public function create() {
        $dl = new DataLayer();
        $userID = Auth::user()->id;

        return view('router.editRouter');
    }

    public function edit($serialNumber) {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $router = $dl->findRouterBySerial($serialNumber);

        return view('router.generateConfig')->with('router', $router);
    }

    public function store(Request $request) {

        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $dl->addRouter($request->input('name'), $request->input('model'), $request->input('firmware'), $request->input('ports'), $request->input('serialNumber'), $userID);
        return Redirect::to(route('router.index'));
    }
    
    public function search(Request $request) {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $routers_list = $dl->searchRouters($request->input('keyword'), $userID);
        
        return view('router.routerList')->with('routers_list', $routers_list);
    }
    
    public function list() {
        
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $routers_list = $dl->listRouters($userID);
        
        return view('router.routerList')->with('routers_list', $routers_list);
    }

    public function destroy($serialNumber) {

        $dl = new DataLayer();
        $dl->deleteRouter($serialNumber);
        return Redirect::to(route('router.index'));
    }

    public function deleteConfiguration($serialNumber) {

        $dl = new DataLayer();
        $dl->deleteConfiguration($serialNumber);
        return Redirect::to(route('router.index'));
    }

    public function confirmDestroy($serialNumber) {

        $dl = new DataLayer();
        $router = $dl->findRouterBySerial($serialNumber);

        if ($router !== null) {
            return view('router.deleteRouter')->with('router', $router);
        } else {
            return view('router.deleteErrorPage');
        }
    }

    public function deleteConfigurationConfirm($serialNumber) {

        $dl = new DataLayer();
        $router = $dl->findRouterBySerial($serialNumber);
        $configuration = $dl->findConfigurationBySerial($serialNumber);

        if ($router !== null) {
            return view('router.deleteRouterConfiguration')->with('router', $router)->with('configuration', $configuration);
        } else {
            return view('router.deleteErrorPage');
        }
    }

    public function update(Request $request) {

        $dl = new DataLayer();
        $dl->addConfiguration($request->input('hostname'), $request->input('username'), $request->input('password'), $request->input('domainName'), $request->input('interface'), $request->input('int-ip-address'), $request->input('subnetMask'), $request->input('gateway'), $request->input('serialNumber'));
        return Redirect::to(route('router.index'));
    }

}
