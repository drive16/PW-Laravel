<?php

namespace NetworkConfigurator\Http\Controllers;

use Illuminate\Http\Request;
use NetworkConfigurator\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class SwitchController extends Controller
{
    public function index() 
    {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $switches_list = $dl->listSwitches($userID);
        
        return view('switch.switch')->with('switches_list', $switches_list);
    }
    
    public function create()
    {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
                
        return view('switch.editSwitch');
    }
    
    public function edit($serialNumber)
    {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $switch = $dl->findSwitchBySerial($serialNumber);
        
        return view('switch.generateConfig')->with('switch', $switch);
    }
    
    public function store(Request $request)
    {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $dl->addSwitch($request->input('name'), $request->input('model'), $request->input('firmware'), $request->input('ports'), $request->input('serialNumber'), $userID);
        return Redirect::to(route('switch.index'));
    }
    
    public function search(Request $request) {
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $switches_list = $dl->searchSwitches($request->input('keyword'), $userID);
        
        return view('switch.switchList')->with('switches_list', $switches_list);
    }
    
    public function list() {
        
        $dl = new DataLayer();
        $userID = Auth::user()->id;
        $switches_list = $dl->listSwitches($userID);
        
        return view('switch.switchList')->with('switches_list', $switches_list);
    }
    
    public function destroy($serialNumber)
    {
        $dl = new DataLayer();
        $dl->deleteSwitch($serialNumber);
        return Redirect::to(route('switch.index'));
    }
    
    public function deleteConfiguration($serialNumber) {

        $dl = new DataLayer();
        $dl->deleteConfiguration($serialNumber);
        return Redirect::to(route('switch.index'));
    }
    
    public function confirmDestroy($serialNumber)
    {
        $dl = new DataLayer();
        $switch = $dl->findSwitchBySerial($serialNumber);
        
        if($switch !== null) {
            return view('switch.deleteSwitch')->with('switch', $switch);
        } else {
            return view('switch.deleteErrorPage');
        }
    }
    
    public function deleteConfigurationConfirm($serialNumber) {

        $dl = new DataLayer();
        $switch = $dl->findSwitchBySerial($serialNumber);
        $configuration = $dl->findConfigurationBySerial($serialNumber);

        if ($switch !== null) {
            return view('switch.deleteSwitchConfiguration')->with('switch', $switch)->with('configuration', $configuration);
        } else {
            return view('switch.deleteErrorPage');
        }
    }
    
    public function update(Request $request)
    {
        $dl = new DataLayer();
        $dl->addSwitchConfiguration($request->input('hostname'), $request->input('username'), $request->input('password'), $request->input('domainName'), $request->input('interface'), $request->input('int-ip-address'), $request->input('subnetMask'), $request->input('gateway'), $request->input('serialNumber'));
        return Redirect::to(route('switch.index'));
    }
}
