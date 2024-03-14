@extends('petugas.Inventarisasi.pdf.layout')
@section('content')
    {{-- Content --}}
            {{-- Section 1 --}}
            <div class="px-4 flex my-5">
                <div class="flex items-center">
                    <h1 class=" text-black font-bold items-center text-center">
                        <span class="text-2xl">Perpustakaan Fakultas Teknik </span><br> <span>Universitas Diponegoro</span>
                    </h1>
                    <h3 class="text-black font-bold items-center text-center text-2">
                        Laporan Stock Opname
                    </h3>
                </div>
            </div>
            {{-- End Section 1 --}}
            {{-- Section 2 --}}
            <form action="{{ route('client.stockopname', ['id' => $stockopnames[0]->id]) }}">
                <div class="center">
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
                </div>

            </form>
            {{-- End Section 2 --}}
@endsection

