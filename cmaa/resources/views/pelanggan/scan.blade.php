@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Scan Kode QR Pelanggan</h3>
    <div id="reader" style="width: 300px; margin: auto;"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText) {
        window.location.href = "/pelanggan/" + decodedText;
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 }
    );

    html5QrcodeScanner.render(onScanSuccess);
</script>
@endsection
