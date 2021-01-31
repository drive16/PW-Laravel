/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkDeviceFields(button) {
    if(!checkHostname(button) && !checkUsername(button) && !checkPassword(button) && !checkDomainName(button) && !checkIPAddress(button) && !checkGateway(button)) {
        button.form.submit();
    }
}

function checkSwitchFields(button) {
    if(!checkHostname(button) && !checkUsername(button) && !checkPassword(button) && !checkDomainName(button) && !checkInterfaceVlan(button) && !checkIPAddress(button) && !checkGateway(button)) {
        button.form.submit();
    }
}

function checkAddDevice(button) {
    if(!checkName(button) && !checkModel(button) && !checkFirmware(button) && !checkSN(button) && !checkPorts(button)) {
        button.form.submit();
    }
}

function checkName(button) {
    
    name = (button.form.name.value).trim();
    name_msg = document.getElementById('invalid-name');
    name_msg.innerHTML = "";
    
    var regExp = new RegExp("[a-zA-Z\-0-9]");
    var error = false;

    if (name === "") {
        name_msg.innerHTML = "The name field must not be empty!";
        button.form.name.focus();
        error = true;
    } else if (!name.match(regExp)) {
        name_msg.innerHTML = "The name field can contain only letters, digits and dashes!";
        button.form.name.focus();
        error = true;
    }
    
    return error;
}

function checkSN(button) {

    serialNumber = (button.form.serialNumber.value).trim(); //elimino gli spazi superflui con la funzione trim()
    serialNumber_msg = document.getElementById('invalid-SN');
    serialNumber_msg.innerHTML = "";

    var regExp = new RegExp("[A-Z0-9]{11}");
    var error = false;

    if (serialNumber === "") {
        serialNumber_msg.innerHTML = "The serialNumber field must not be empty!";
        button.form.serialNumber.focus();
        error = true;
    } else if (!serialNumber.match(regExp)) {
        serialNumber_msg.innerHTML = "The serialNumber field must contain only capital letters and digits and must be 11 characters long!";
        button.form.serialNumber.focus();
        error = true;
    }

    return error;

}

function checkModel(button) {
    model = (button.form.model.value).trim();
    model_msg = document.getElementById('select-model');
    model_msg.innerHTML = "";
    
    var error = false;
    
    if (!model) {
        model_msg.innerHTML = "You must select the model";
        button.form.model.focus();
        error = true;
    } else {
        return error;
    }
}

function checkPorts(button) {
    
    ports = (button.form.ports.value).trim();
    ports_msg = document.getElementById('select-ports');
    ports_msg.innerHTML = "";
    
    var error = false;
    
    if (!ports) {
        ports_msg.innerHTML = "You must select the number of ports";
        button.form.ports.focus();
        error = true;
    } else {
        return error;
    }
}

function checkFirmware(button) {

    firmware = (button.form.firmware.value).trim();
    firmware_msg = document.getElementById('invalid-firmware');
    firmware_msg.innerHTML = "";

    var regExp = new RegExp("^([0-9]{2}[.]?)+");
    var error = false;

    if (firmware === "") {
        firmware_msg.innerHTML = "The firmware field must not be empty!";
        button.form.firmware.focus();
        error = true;
    } else if (!firmware.match(regExp)) {
        firmware_msg.innerHTML = "The firmware field must contain only digits and dots!";
        button.form.firmware.focus();
        error = true;
    }

    return error;
}

function checkHostname(button) {

    hostname = (button.form.hostname.value).trim();
    hostname_msg = document.getElementById('invalid-hostname');
    hostname_msg.innerHTML = "";

    var regExp = new RegExp("[a-zA-Z\-0-9]");
    var error = false;

    if (hostname === "") {
        hostname_msg.innerHTML = "The hostname field must not be empty!";
        button.form.hostname.focus();
        error = true;
    } else if (!hostname.match(regExp)) {
        hostname_msg.innerHTML = "The hostname field can contain only letters, digits and dashes!";
        button.form.hostname.focus();
        error = true;
    }
    
    return error;

}

function checkUsername(button) {

    username = (button.form.username.value).trim();
    username_msg = document.getElementById('invalid-username');
    username_msg.innerHTML = "";

    var regExp = new RegExp("[a-zA-Z0-9]");
    var error = false;

    if (username === "") {
        username_msg.innerHTML = "The username field must not be empty!";
        button.form.username.focus();
        error = true;
    } else if (!username.match(regExp)) {
        username_msg.innerHTML = "The username field must contain only letters or digits!";
        button.form.username.focus();
        error = true;
    }
    
    return error;
}

function checkPassword(button) {

    password = (button.form.password.value).trim();
    password_msg = document.getElementById('invalid-password');
    password_msg.innerHTML = "";

    var error = false;

    if (password === "") {
        password_msg.innerHTML = "The password field must not be empty!";
        button.form.password.focus();
        error = true;
    }

    return error;
}


function checkDomainName(button) {

    domainName = (button.form.domainName.value).trim();
    domainName_msg = document.getElementById('invalid-domainName');
    domainName_msg.innerHTML = "";

    var regExp = new RegExp("[a-z]+\.[a-z]+");
    var error = false;

    if (domainName === "") {
        domainName_msg.innerHTML = "The domainName field must not be empty!";
        button.form.domainName.focus();
        error = true;
    } else if (!domainName.match(regExp)) {
        domainName_msg.innerHTML = "The domainName field must contain only letters!";
        button.form.domainName.focus();
        error = true;
    }

    return error;
}

function checkIPAddress(button) {

    ipAddress = (button.form.ipAddress.value).trim();
    ipAddress_msg = document.getElementById('invalid-ipAddress');
    ipAddress_msg.innerHTML = "";

    var regExp = new RegExp("^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$");
    var error = false;

    if (ipAddress === "") {
        ipAddress_msg.innerHTML = "The ipAddress field must not be empty!";
        button.form.ipAddress.focus();
        error = true;
    } else if (!ipAddress.match(regExp)) {
        ipAddress_msg.innerHTML = "The ipAddress field must contain a valid IP address!";
        button.form.ipAddress.focus();
        error = true;
    }

    return error;
}

function checkGateway(button) {

    gateway = (button.form.gateway.value).trim();
    gateway_msg = document.getElementById('invalid-gateway');
    gateway_msg.innerHTML = "";

    var regExp = new RegExp("^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$");
    var error = false;

    if (gateway === "") {
        gateway_msg.innerHTML = "The gateway field must not be empty!";
        button.form.gateway.focus();
        error = true;
    } else if (!gateway.match(regExp)) {
        gateway_msg.innerHTML = "The gateway field must contain a valid IP address!";
        button.form.gateway.focus();
        error = true;
    }

    return error;
}

function checkNetwork(button) {

    network = (button.form.network.value).trim();
    network_msg = document.getElementById('invalid-network');
    network_msg.innerHTML = "";

    var regExp = new RegExp("^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}(0)$");    

    if (network === "") {
        network_msg.innerHTML = "The network field must not be empty!";
        button.form.network.focus();
        return false;
    } else if (!network.match(regExp)) {
        network_msg.innerHTML = "The network field must contain a valid network statement!";
        button.form.network.focus();
        return false;
    } else {
        return true;
    }
}

function checkSwitchInterfaceQuickConfiguration(button) {

    ports = (button.form.ports.value).trim();
    interface = (button.form.interface.value).trim();
    speed = (button.form.speed.value).trim();
    switchport = (button.form.switchport.value).trim();

    var error = false;

    if (ports === "" || interface === "" || speed === "" || switchport === "") {
        alert("You must select a value for every form!");
        error = true;
    } else if (!error) {
        button.form.submit();
    }
}

function checkInterfaceVlan(button) {
    interface = (button.form.interface.value).trim();
    interface_msg = document.getElementById('invalid-interface');
    interface_msg.innerHTML = "";

    var regExp = new RegExp("^[1-4][0-9]{0,3}$");
    var error = false;

    if (interface === "") {
        interface_msg.innerHTML = "The interface field must not be empty!";
        button.form.interface.focus();
        error = true;
    } else if (!interface.match(regExp)) {
        interface_msg.innerHTML = "The interface field must contain an integer between 1 and 4094!";
        button.form.interface.focus();
        error = true;
    }

    return error;
}

function checkInterfaceQuickConfiguration(button) {

    ports = (button.form.ports.value).trim();
    interface = (button.form.interface.value).trim();
    speed = (button.form.speed.value).trim();

    var error = false;

    if (ports === "" || interface === "" || speed === "") {
        alert("You must select a value for every form!");
        error = true;
    } else if (!error) {
        button.form.submit();
    }
}

function checkSpanningQuickConfiguration(button) {

    spanningTree = (button.form.spanningtree.value).trim();

    var error = false;

    if (spanningTree === "") {
        alert("You must select a value for every form!");
        error = true;
    } else if (!error) {
        button.form.submit();
    }
}

function checkRoutingQuickConfiguration(button) {

    routingProtocol = (button.form.routingprotocol.value).trim();

    var error = false;

    if (routingProtocol === "" || !checkNetwork(button)) {
        alert("You must select a value for every form!");
        error = true;
    } else if (!error) {
        
        button.form.submit();
    }
}

function configurationForm(str) {
    $('#quickConfigurationForm').trigger('reset'); //per ripristinare i valori delle form in caso di selezione di una sezione diversa
    
    if (str === "interface-form") {
        document.getElementById('interfaceButton').style.display = "";
        document.getElementById('spanningButton').style.display = "none";
        document.getElementById('routingButton').style.display = "none";
        document.getElementById('spanning-tree-configuration').style.display = "none";
        document.getElementById('priority-configuration').style.display = "none";
        document.getElementById('routing-configuration').style.display = "none";
        document.getElementById('ports-selection').style.display = "";
        document.getElementById('interface-configuration').style.display = "";
        document.getElementById('switchport-configuration').style.display = "";
        document.getElementById('speed-configuration').style.display = "";
        document.getElementById('portfast-configuration').style.display = "";
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
        document.getElementById('subnetmask-configuration').style.display = "none";
    } else if (str === "stp-form") {
        document.getElementById('interfaceButton').style.display = "none";
        document.getElementById('spanningButton').style.display = "";
        document.getElementById('routingButton').style.display = "none";
        document.getElementById('ports-selection').style.display = "none";
        document.getElementById('interface-configuration').style.display = "none";
        document.getElementById('switchport-configuration').style.display = "none";
        document.getElementById('speed-configuration').style.display = "none";
        document.getElementById('duplex-configuration').style.display = "none";
        document.getElementById('portfast-configuration').style.display = "none";
        document.getElementById('bpduguard-configuration').style.display = "none";
        document.getElementById('spanning-tree-configuration').style.display = "";
        document.getElementById('priority-configuration').style.display = "";
        document.getElementById('routing-configuration').style.display = "none";
        document.getElementById('vlan-configuration').style.display = "none";
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
        document.getElementById('subnetmask-configuration').style.display = "none";
    } else {
        document.getElementById('interfaceButton').style.display = "none";
        document.getElementById('spanningButton').style.display = "none";
        document.getElementById('routingButton').style.display = "";
        document.getElementById('ports-selection').style.display = "none";
        document.getElementById('interface-configuration').style.display = "none";
        document.getElementById('switchport-configuration').style.display = "none";
        document.getElementById('speed-configuration').style.display = "none";
        document.getElementById('duplex-configuration').style.display = "none";
        document.getElementById('portfast-configuration').style.display = "none";
        document.getElementById('bpduguard-configuration').style.display = "none";
        document.getElementById('spanning-tree-configuration').style.display = "none";
        document.getElementById('priority-configuration').style.display = "none";
        document.getElementById('vlan-configuration').style.display = "none";
        document.getElementById('routing-configuration').style.display = "";
    }
}

function routerConfigurationForm(str) {
    $('#quickConfigurationForm').trigger('reset'); //per ripristinare i valori delle form in caso di selezione di una sezione diversa
    
    if (str === "interface-form") {
        document.getElementById('interfaceButton').style.display = "";
        document.getElementById('routingButton').style.display = "none";
        document.getElementById('routing-configuration').style.display = "none";
        document.getElementById('ports-selection').style.display = "";
        document.getElementById('interface-configuration').style.display = "";
        document.getElementById('subnetmask-configuration').style.display = "";
        document.getElementById('speed-configuration').style.display = "";
        document.getElementById('address-configuration').style.display = "";
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
    } else if (str === "routing-form") {
        document.getElementById('interfaceButton').style.display = "none";
        document.getElementById('routingButton').style.display = "";
        document.getElementById('routing-configuration').style.display = "";
        document.getElementById('ports-selection').style.display = "none";
        document.getElementById('duplex-configuration').style.display = "none";
        document.getElementById('interface-configuration').style.display = "none";
        document.getElementById('subnetmask-configuration').style.display = "none";
        document.getElementById('speed-configuration').style.display = "none";
        document.getElementById('address-configuration').style.display = "none";
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
    }
}


function showDuplexSetting() {
    $('#duplex').empty();
    var speedSelected = document.getElementById('speed').value;
    if (speedSelected !== "auto" && speedSelected !== "1000") {
        document.getElementById('duplex-configuration').style.display = "";
        $('#duplex').append('<option value="half">Half</option>');
        $('#duplex').append('<option value="full">Full</option>');
    } else if (speedSelected === "1000") {
        document.getElementById('duplex-configuration').style.display = "";
        $('#duplex').append('<option value="full">Full</option>');
    } else {
        document.getElementById('duplex-configuration').style.display = "";
        $('#duplex').append('<option value="auto">Auto</option>');
    }
}

function showBPDU() {
    var portfastCheckbox = document.getElementById('portfast');
    if (portfastCheckbox.checked === true) {
        document.getElementById('bpduguard-configuration').style.display = "";
    } else {
        document.getElementById('bpduguard-configuration').style.display = "none";
    }
}

function showOSPF() {
    var routingSelected = document.getElementById('routingprotocol').value;
    if (routingSelected === "ospf") {
        document.getElementById('network-configuration').style.display = "";
        document.getElementById('area-configuration').style.display = "";
        document.getElementById('subnetmask-configuration').style.display = "";
    } else {
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
        document.getElementById('subnetmask-configuration').style.display = "none";
    }
}

function showRouting() {
    var routingSelected = document.getElementById('routingprotocol').value;
    if (routingSelected === "ospf") {
        document.getElementById('network-configuration').style.display = "";
        document.getElementById('area-configuration').style.display = "";
        document.getElementById('subnetmask-configuration').style.display = "";
    } else {
        document.getElementById('network-configuration').style.display = "none";
        document.getElementById('area-configuration').style.display = "none";
        document.getElementById('subnetmask-configuration').style.display = "none";
    }
}

function showVLAN() {
    var selected = document.getElementById('switchport').value;
    if(selected === "access") {
        document.getElementById('vlan-configuration').style.display = "";
    } else {
        document.getElementById('vlan-configuration').style.display = "none";
    }
}
