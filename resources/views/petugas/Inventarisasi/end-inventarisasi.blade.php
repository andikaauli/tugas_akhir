@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
@section('active-end-inventarisasi', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')

{{-- Content --}}
<div class="sm:ml-64">
    <div class="mt-18">
        {{-- Section 1 --}}
        <div class="px-4 pt-4 flex my-5">
            <div class="flex items-center">
                <p class="text-3xl text-black font-bold">
                    Akhiri Proses Stock Opname
                </p>
            </div>
        </div>
        {{-- End Section 1 --}}
        {{-- Section 2 --}}
        <div class="py-3 px-4 bg-blue-100">
            <div class="p-4 bg-green-500">
                <p class="text-white">Anda yakin mengakhiri proses Stock Opname? Setelah diakhiri Anda tidak bisa
                    mengubah kembali data Stock Opname</p>
            </div>
        </div>
        {{-- End Section 2 --}}
        {{-- Section 2 --}}
        <div class="bg-white">
            {{-- Btn Simpan --}}
            <form action="{{ route('client.end-stockopname') }}" method="POST"
                class="flex border-b border-solid border-gray-300 px-4 py-3">
                @csrf
                <button type="submit"
                    class="py-2 px-3 rounded text-white text-sm font-bold bg-blue-600 hover:bg-blue-500">Selesaikan
                    Stock Opname</button>
            </form>
            {{-- End Btn Simpan --}}
        </div>
        {{-- End Section 2 --}}
    </div>
</div>
