<!DOCTYPE html>
<html>
<head>
    <title>Cetak Semua Kartu Pelanggan</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        @media print {
            .page-break {
                page-break-after: always;
            }

            body {
                margin: 0;
            }
        }

        .card {
            width: 240px;
            height: 140px;
            border: 1px solid #999;
            border-radius: 10px;
            margin: 10px;
            padding: 10px;
            text-align: center;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
        }

        .header {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 6px;
            color: #333;
        }

        .kartu-id {
            font-size: 14px;
            font-family: monospace;
            color: #0c4a6e;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

    @foreach($pelanggans as $index => $p)
        <div class="card">
            <div class="header">Kartu Cuci Motor</div>
            <div class="kartu-id">{{ $p->kartu_id }}</div>
            <div>
                {!! QrCode::size(80)->generate($p->kartu_id) !!}
            </div>
        </div>

        @if(($index + 1) % 8 == 0)
            <div class="page-break"></div>
        @endif
    @endforeach

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
