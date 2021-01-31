@extends('layouts.master')

@section('titolo')
{{ trans('labels.quickConfiguration') }}
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
        <div class="col-md-12">
            <div id="configuration">
                @if(!empty($ports) && !empty($ipAddress))
                <dl>
                    <dd>interface {{ $interface }}</dd>
                    <dd>&ensp;speed {{ $speed }}</dd>
                    <dd>&ensp;duplex {{ $duplex }}</dd>
                    <dd>&ensp;ip address {{ $ipAddress }} {{ $subnetmask }}</dd>
                </dl>
                @elseif($routingprotocol === 'ospf')
                <dl>
                    <dd>router ospf 1</dd>
                    <dd>&ensp;network {{ $network }} {{ $subnetmask }} area {{ $area }}</dd>
                </dl>
                @endif
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
</script>
@endsection

