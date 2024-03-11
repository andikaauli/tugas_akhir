<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}

    <title>Laravel</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}

    {{-- <style>
        {{-- <style>
            body {
                font-family: 'quicksand';
            }
        </style>
        @vite('resources/css/app.css') --}}
        <style>

        </style>
    <style>
        .flex {
            display: flex;
        }

        .text-center{
            text-align: center;
        }

        .w-60{
            width: 300px;
        }

        .w-40{
            width: 200px;
        }

        .items-center {
            align-items: center;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .pt-4 {
            padding-top: 1rem;
        }

        .my-5 {
            margin-top: 1.25rem;
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .h-full {
            height: 100%;
        }

        .border-y {
            border-top-width: 1px;
            border-bottom-width: 1px;
        }

        .border-solid {
            border-style: solid;
        }

        .table-auto {
            table-layout: auto;
        }

        th{
            height: 40px;
        }

        td{
            padding-left: 12px;
            padding-right: 12px;'
            padding-top: 6px;
            padding-bottom: 6px;
        }

        table {
            background-color: #f2f2f2;
            border-collapse: collapse;
        }
        table, td, th {
  border: 1px solid black;
}
table, td, td {
  border: 1px solid black;
}

        body {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    {{-- Content --}}
    <div class="sm:ml-64">
        <div class="mt-18">
            {{-- Section 1 --}}
            <div class="px-4 pt-4 flex my-5">
                <div class="flex items-center">
                    <h1 class="text-3xl text-black font-bold items-center text-center">
                        Laporan Stock Opname
                    </h1>
                    <h1 class="text-3xl text-black font-bold items-center text-center">
                        Perpustakaan Fakultas Teknik Universitas Dipoengoro
                    </h1>
                </div>
                {{-- @endif --}}
            </div>
            {{-- End Section 1 --}}
            {{-- Section 2 --}}
            <form action="{{ route('client.stockopname', ['id' => $stockopnames[0]->id]) }}">
                <table class="table-auto">
                    <thead>
                        <tr>
                            <th class="w-60">KETERANGAN</th>
                            <th class="w-40">DATA HASIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama Stock Opname</td>
                            <td>{{ $stockopnames[0]->stockopname_name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames[0]->start_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames[0]->end_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Yang Menginisialisasi</td>
                            <td>{{ $stockopnames[0]->name_user }}</td>
                        </tr>
                        <tr>
                            <td>Total Eksemplar Dimiliki</td>
                            <td>{{ $stockopnames['total_eksemplar'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Eksemplar yang Diperiksa</td>
                            <td>{{ $stockopnames['total_diperiksa'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Eksemplar Hilang</td>
                            <td>{{ $stockopnames['total_hilang'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Eksmplar Tersedia</td>
                            <td>{{ $stockopnames['total_tersedia'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Eksemplar Terpinjam</td>
                            <td>{{ $stockopnames['total_dipinjam'] }}</td>
                        </tr>
                        <tr>
                            <td>Progres Eksemplar Terpindai</td>
                            <td>@php
                                $num = $stockopnames['total_persen'];
                                $formattedNum = number_format($num);
                            @endphp
                                {{ $formattedNum }}% / 100%
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $stockopnames[0]->status_stockopname }}</td>
                        </tr>
                    </tbody>
                </table>

            </form>
            {{-- End Section 2 --}}
        </div>
    </div>
</body>

</html>
