<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak QR Pelanggan</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 2rem;
        }
        .card {
            border: 1px solid #ccc;
            padding: 2rem;
            width: 300px;
            margin: auto;
        }
        .qr {
            margin: 1rem 0;
        }
        .kartu-id {
            font-size: 18px;
            font-weight: bold;
            color: #2b6cb0;
            font-family: monospace;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="card">
        <h2>Cuci Motor AthaVex</h2>
        <div class="qr">
            {!! QrCode::size(200)->generate($pelanggan->kartu_id) !!}
        </div>
        <div class="kartu-id">{{ $pelanggan->kartu_id }}</div>
    </div>
</body>
</html>
