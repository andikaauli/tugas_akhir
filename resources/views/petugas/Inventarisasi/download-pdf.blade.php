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
            .flex {
                display: flex;
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
            h1{
                text-align: center;
            }
            table, tr, td {
                /* border: 1px solid; */
                border: 1px solid #000000;
                padding: 8px 20px;
            }
            table{
                width: 100%;
            }

        </style>
</head>
<body class="">
    {{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <h1 class="text-3xl text-black font-bold">
                Hasil Stock Opname
             </h1>
          </div>
          {{-- @endif --}}
       </div>
     {{-- End Section 1 --}}
        {{-- Section 2 --}}
    <form action="{{ route('client.stockopname', ['id' => $stockopnames->id]) }}">
        <table class="table-auto">
            <thead>
              <tr>
                <th>Keterangan</th>
                <th>Data Hasil</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nama Stock Opname</td>
                <td>{{$stockopnames->name}}</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames->start_date)) }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($stockopnames->end_date)) }}</td>
            </tr>
            <tr>
                <td>Yang Menginisialisasi</td>
                <td>{{$stockopnames->name_user}}</td>
            </tr>
            <tr>
                <td>Total Eksemplar Dimiliki</td>
                <td>{{$stockopnames->total_eksemplar}}</td>
            </tr>
            <tr>
                <td>Total Eksemplar yang Diperiksa</td>
                <td>{{$stockopnames->total_diperiksa}}</td>
            </tr>
            <tr>
                <td>Total Eksemplar Hilang</td>
                <td>{{$stockopnames->total_hilang}}</td>
            </tr>
            <tr>
                <td>Total Eksmplar Tersedia</td>
                <td>{{$stockopnames->total_tersedia}}</td>
            </tr>
            <tr>
                <td>Total Eksemplar Terpinjam</td>
                <td>{{$stockopnames->total_terpinjam}}</td>
            </tr>
            <tr>
                <td>Progres Eksemplar Terpindai</td>
                <td>@php
                        $num = $stockopnames->total_persen;
                        $formattedNum = number_format($num);
                    @endphp
                    {{$formattedNum}}% / 100%
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{$stockopnames->status_stockopname}}</td>
            </tr>
            </tbody>
          </table>

    </form>
   {{-- End Section 2 --}}
    </div>
</div>
</body>
</html>


