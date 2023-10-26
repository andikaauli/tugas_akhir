@extends('dashboard.main')
<div class="flex items-center justify-center pt-32">
    <form action="{{ route('client.create-visitors')}}" method="POST" class="m-0 p-0">
        {{-- Section 1 --}}
        @csrf
        <div class="border-black border">
            <div class="py-6 bg-teknik">
                <p class="text-center text-white text-2xl font-semibold">Penghitung Jumlah Pengunjung</p>
            </div>
            <div class="">
                <div class="p-4">
                    <p class="text-sm font-semibold">Silahkan masukkan nomor anggota Anda atau masukkan nama lengkap Anda</p>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-bold">Nama Pengunjung</p>
                    </div>
                    <div class="p-3">
                        <input class="w-full rounded-md" type="text" name="name">
                    </div>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-bold">Institusi </p>
                    </div>
                    <div class="p-3">
                        <input class="w-full rounded-md" type="text" name="institution">
                    </div>
                </div>
                <div class="">
                    <div class="py-1">
                        <p class="text-center text-base font-semibold">Tipe Pengunjung</p>
                    </div>
                    <div class="p-3">
                        <select class="w-full rounded-md text-center" name="jenis_id">
                            @foreach ($type as $option)
                                <option value="{{ $option->id }}"
                                    {{-- {{ $bibliografi->author_id == $option->id ? 'selected' : '' }}> --}}>
                                    {{ $option->name }}

                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-3">
                    <button type="submit" class="bg-teknik w-full rounded-md text-white font-bold text-base py-2.5">
                        Absen
                    </button>
                </div>
            </div>

        </div>
        {{-- End Section 1 --}}
    </form>
</div>
