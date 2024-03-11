@extends('main.main')
@section('active-mulai-sirkulasi', 'bg-white bg-opacity-30')
@section('active-sirkulasi-navbar', 'text-blue-500 border-blue-500')

@section('content')
<div class="mt-18 ml-64">
    @include('petugas.sirkulasi.sidebar')
    {{-- Section 1 --}}
    <div class="px-4 pt-4 flex my-5">
        <div class="flex items-center">
            <p class="text-3xl text-black font-bold">
                Sirkulasi
            </p>
        </div>
    </div>
    {{-- End Section 1 --}}
    {{-- Section 2 --}}
    <form action="{{ route('client.loan-transaksi', [encrypt($members->id)]) }}" method="POST">
        @csrf
        <div class="bg-white mb-6">
            <div class="p-4">
                <button type="submit"
                    class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Selesai
                    Transaksi</button>
            </div>
            <div class="grid grid-cols-2 gap-0">
                <div class="">
                    <div class="flex border-b border-gray-200">
                        <div class="font-bold text-sm w-48 px-4 py-3">
                            <p>Nama Anggota</p>
                        </div>
                        <div class="font-normal text-sm px-4 py-3">
                            <p>{{ $members->name }}</p>
                        </div>
                    </div>
                    <div class="flex border-b border-gray-200">
                        <div class="font-bold text-sm w-48 px-4 py-3">
                            <p>Surel Anggota</p>
                        </div>
                        <div class="font-normal text-sm px-4 py-3">
                            <p>{{ $members->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="flex border-b border-gray-200">
                        <div class="font-bold text-sm w-48 px-4 py-3">
                            <p>ID Anggota</p>
                        </div>
                        <div class="font-normal text-sm px-4 py-3">
                            <p>{{ $members->nim }}</p>
                        </div>
                    </div>
                    <div class="flex border-b border-gray-200">
                        <div class="font-bold text-sm w-48 px-4 py-3">
                            <p>Tanggal Registrasi</p>
                        </div>
                        <div class="font-normal text-sm px-4 py-3">
                            <p>{{ \Carbon\Carbon::createFromTimestamp(strtotime($members->created_at))->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End Section 2 --}}
    {{-- Tabs --}}
    <div class="container ">
        <div class="tab_box w-full flex items-center border-b border-gray-200 relative">
            <div class="p-3"></div>
            <button
                class="tab_btn w-44 text-sm font-bold px-4 py-3 actived border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Peminjaman</button>
            <button
                class="tab_btn w-44 text-sm font-bold px-4 py-3 border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Peminjaman
                Saat Ini</button>
            <button
                class="tab_btn w-44 text-sm font-bold px-4 py-3 border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Sejarah
                Peminjaman</button>
            <div class="line absolute top-11 left-6 bg-white w-44 h-1"></div>
        </div>
        <div class="content_box">
            <div class="content hidden bg-white animate-move duration-500 p-5 actived">
                {{-- Search Bar --}}
                <form class="flex items-center p-4"
                    action="{{ route('client.loan-pinjam', encrypt($members->id)) }}" method="POST">
                    @csrf
                    <p class="mr-3 text-sm font-medium">Masukkan Kode Eksemplar</p>
                    <input type="search" name="item_code"
                        class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        placeholder="Masukkan Kode Eksemplar" aria-label="Search" aria-describedby="button-addon3" />
                    {{-- Btn Search --}}
                    <button type="submit"
                        class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">Pinjam</button>
                    {{-- End Btn Search --}}
                </form>
                {{-- End Search Bar --}}
                <table class="table-auto w-full">
                    <thead class="p-3 border-b border-solid border-gray-200">
                        <tr class="text-sm">
                            <th class="text-left p-3">HAPUS</th>
                            <th class="text-left p-3">KODE EKSEMPLAR</th>
                            <th class="text-left p-3">JUDUL</th>
                            <th class="text-left p-3">TANGGAL PINJAM</th>
                            <th class="text-left p-3">BATAS KEMBALI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_filter($loans, fn($loan) => $loan->loan_status == null) as $item)
                        {{-- @dd($item) --}}
                            <tr class="border-b border-solid text-sm font-medium border-gray-200">
                                {{-- <td class="p-3 w-18">
                                    <button
                                        class="text-xs text-white font-bold bg-red-600 hover:bg-red-700 p-1.5 rounded">Hapus</button>
                                </td> --}}
                                <td class="p-3 w-18">
                                    <form class="m-0"
                                        action="{{ route('client.loan-hapus', encrypt($item->id)) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs text-white font-bold bg-red-600 hover:bg-blue-500 p-1.5 rounded">Hapus</button>
                                    </form>
                                </td>
                                <td class="p-3 w-40">{{$item->eksemplar->item_code}}</td>
                                <td class="p-3">
                                    <p class="">{{$item->eksemplar->biblio->title}}</p>
                                </td>
                                <td class="p-3 w-36">{{ Carbon\Carbon::parse($item->loan_date)->format('Y-m-d') }}</td>
                                <td class="p-3 w-40">{{ Carbon\Carbon::parse($item->due_date)->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="content_box">
            <div class="content hidden bg-white animate-move duration-500 p-5">
                <table class="table-auto w-full">
                    <thead class="p-3 border-b border-solid border-gray-200">
                        <tr class="text-sm">
                            <th class="text-left p-3">KEMBALI</th>
                            <th class="text-left p-3">PERPANJANG</th>
                            <th class="text-left p-3">KODE EKSEMPLAR</th>
                            <th class="text-left p-3">JUDUL</th>
                            <th class="text-left p-3">TIPE KOLEKSI</th>
                            <th class="text-left p-3">TANGGAL PINJAM</th>
                            <th class="text-left p-3">BATAS KEMBALI</th>
                            <th class="text-left p-3">KETERLAMBATAN</th>
                            <th class="text-left p-3">DENDA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_filter($loans, fn($loan) => $loan->loan_status == 'Sedang Dipinjam') as $item)
                        {{-- @dd($item) --}}
                            <tr class="border-b border-solid text-sm font-medium border-gray-200">
                                <td class="p-3 w-18">
                                    <form class="m-0"
                                        action="{{ route('client.loan-pengembalian', ['loan' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs text-white font-bold bg-blue-600 hover:bg-blue-500 p-1.5 rounded">Kembali</button>
                                    </form>
                                </td>
                                {{-- <td class="p-3 w-18">
                                    <form class="m-0"
                                        action="{{ route('client.loan-perpanjang', ['loan' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        <button
                                            class="text-xs text-white font-bold bg-green-500 hover:bg-green-600 p-1.5 rounded">Perpanjang</button>
                                    </form>
                                </td> --}}
                                <td class="p-3 w-18">
                                    @if ($item->day_overdue)
                                      <button type="button" disabled class="text-xs text-white font-bold bg-gray-500 p-1.5 rounded">Perpanjang</button>
                                    @else
                                      <form class="m-0"
                                            action="{{ route('client.loan-perpanjang', ['loan' => $item->id]) }}"
                                            method="post">
                                        @csrf
                                        <button type="submit" class="text-xs text-white font-bold bg-green-500 hover:bg-green-600 p-1.5 rounded">Perpanjang</button>
                                      </form>
                                    @endif
                                  </td>
                                <td class="p-3 w-40">{{$item->eksemplar->item_code}}</td>
                                <td class="p-3">
                                    <p class="">{{$item->eksemplar->biblio->title}}</p>
                                </td>
                                <td class="p-3 w-32">{{$item->eksemplar->biblio->colltype->title}}</td>
                                <td class="p-3 w-40">{{ Carbon\Carbon::parse($item->loan_date)}}</td>
                                <td class="p-3 w-40">{{ Carbon\Carbon::parse($item->due_date)}}</td>
                                @if(isset($item->day_overdue))
                                    <td class="p-3 w-24">{{ $item->day_overdue }} hari</td>
                                @else
                                    <td class="p-3 w-24"> - </td>
                                @endif
                                @if(isset($item->late_charge))
                                    <td class="p-3 w-24">Rp. {{ $item->late_charge }}</td>
                                @else
                                    <td class="p-3 w-24"> - </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="content_box">
            <div class="content hidden bg-white animate-move duration-500 p-0">
                <table class="table-auto w-full">
                    <thead class="p-3 border-b border-solid border-gray-200">
                        <tr class="text-sm">
                            <th class="text-left p-3">KODE EKSEMPLAR</th>
                            <th class="text-left p-3">JUDUL</th>
                            <th class="text-left p-3">TANGGAL PINJAM</th>
                            <th class="text-left p-3">TANGGAL KEMBALI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_filter($loans, fn($loan) => $loan->loan_status == 'Telah Kembali') as $item)
                        {{-- @dd($item) --}}
                                <td class="p-3 w-40">{{$item->eksemplar->item_code}}</td>
                                <td class="p-3">
                                    <p class="">{{$item->eksemplar->biblio->title}}</p>
                                </td>
                                <td class="p-3 w-44">{{ Carbon\Carbon::parse($item->loan_date)}}</td>
                                <td class="p-3 w-44">{{ Carbon\Carbon::parse($item->return_date)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End Tabs --}}
</div>
<script>
    const tabs = document.querySelectorAll('.tab_btn')
    const all_content = document.querySelectorAll('.content')

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', (e) => {
            tabs.forEach(tab => {
                tab.classList.remove('actived')
            });
            tab.classList.add('actived');

            var line = document.querySelector('.line');
            line.style.width = e.target.offsetWidth + "px";
            line.style.left = e.target.offsetLeft + "px";

            all_content.forEach(content => {
                content.classList.remove('actived')
            });
            all_content[index].classList.add('actived');
        })
    })
</script>
@endsection

