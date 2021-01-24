@extends('layouts.master')

@section('titolo')
{{ trans('labels.showConfigurationSwitchTitle') }}
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li><a href="{{ route('home') }}">Home</a></li>
<li><a href="{{ route('router.index') }}">Routers</a></li>
<li class="active"><a href="{{ route('switch.index') }}">Switches</a></li>
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
<li class="active"><a href="{{  route('switch.index') }}">Switches</a></li>
<li class="active">{{ trans('labels.showConfiguration') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 align="center">{{ $switch->name }} - {{ trans('labels.configuration') }}</h3>
            <div id="configuration">
            <dl>
                <dd>hostname {{ $configuration->hostname }}</dd>
            </dl>
            <dl>
                <dd>username {{ $configuration->username }} privilege 15 secret 5 {{ $configuration->password }}</dd>
            </dl>
            <dl>
                <dd>ip domain-name {{ $configuration->domainName }}</dd>
                <dd>crypto key generate rsa modulus 2048</dd>
                <dd>ip ssh version 2</dd>
            </dl>
            <dl>
                <dd>aaa new-model</dd>
                <dd>aaa authentication login default local</dd>
                <dd>aaa authorization exec default local</dd>
            </dl>
            <dl>
                <dd>interface {{ $configuration->interface }}</dd>
                <dd>&ensp;ip address {{ $configuration->ipAddress }} {{ $configuration->subnetMask }}</dd>
            </dl>
            <dl>
                <dd>ip route 0.0.0.0 0.0.0.0 {{ $configuration->gateway }}</dd>
            </dl>
            <dl>
                <dd>line vty 0 15</dd>
                <dd>&ensp;transport input ssh</dd>
            </dl>    
            
            </div>
        </div>
        
        <div class="col-md-offset-3 col-md-6">
            <tbody>
                <tr>
                    <td>{{ trans('labels.saveAs') }}</td>
                    <td><input type="text" id="inputFileNameToSaveAs"></input></td>
                    <td><a class="btn btn-info" onclick="saveTextAsFile()">{{ trans('labels.saveText')}}</a></td>
                </tr>
            </tbody>
        </div>
    </div>
</div>
<script type="text/javascript">

    function saveTextAsFile()
    {
        var textToSave = document.getElementById("configuration").innerText;
        var textToSaveAsBlob = new Blob([textToSave], {type: "text/plain"});
        var textToSaveAsURL = window.URL.createObjectURL(textToSaveAsBlob);
        var fileNameToSaveAs = document.getElementById("inputFileNameToSaveAs").value;

        var downloadLink = document.createElement("a");
        downloadLink.download = fileNameToSaveAs;
        downloadLink.innerHTML = "Download File";
        downloadLink.href = textToSaveAsURL;
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);

        downloadLink.click();
    }

    function destroyClickedElement(event)
    {
        document.body.removeChild(event.target);
    }

    //function loadFileAsText()
    //{
    //    var fileToLoad = document.getElementById("fileToLoad").files[0];
    // 
    //    var fileReader = new FileReader();
    //    fileReader.onload = function(fileLoadedEvent) 
    //    {
    //        var textFromFileLoaded = fileLoadedEvent.target.result;
    //        document.getElementById("inputTextToSave").value = textFromFileLoaded;
    //    };
    //    fileReader.readAsText(fileToLoad, "UTF-8");
    //}

</script>
@endsection


