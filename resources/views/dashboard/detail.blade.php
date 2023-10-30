@extends('dashboard.main')
<div class="pt-32">
    {{-- Section 1 --}}
    <div>

    </div>
    {{-- End Section 1 --}}
    {{-- Setion 2 --}}
    <div class="">
        <div class="grid gap-10 grid-cols-3 grid-rows-3 px-20">
            <div class="col-span-2 border border-black">
                <div class="bg-teknik py-5 text-xl font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="px-12 py-10">
                    <div class="flex w-full">
                        <img src="{{$bibliografi->image}}" class="w-28 h-36"></img>
                        <div class=" ml-4">
                            <p class="text-xl font-bold mb-3">{{$bibliografi->title}}</p>
                            <p class="text-xl font-bold text-slate-600">{{$bibliografi->author->title}}</p>
                        </div>
                    </div>
                    <div class="grid gap-3 grid-cols-2">
                        <div class="col-span-1">
                            <p class="text-end mb-4 text-teknik font-bold text-base">No. Panggil</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">ISBN/ISSN</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">Klasifikasi</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">Penerbit</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">Tempat Terbit</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">Deskripsi Fisik</p>
                            <p class="text-end mb-4 text-teknik font-bold text-base">Ketersediaan</p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->call_number}}</p>
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->isbnissn}}</p>
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->classification}}</p>
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->publisher->title}}</p>
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->place}}</p>
                            <p class="text-start mb-4 font-semibold text-base">{{$bibliografi->description}}</p>
                            <div class="border-t border-black w-fit">
                                @foreach ($eksemplar as $eks)
                                <div class="flex border-b border-black w-fit">
                                    <div class="border-x px-2 py-1.5 border-black w-24">{{$eks->item_code}}</div>
                                    <div class="border-r px-2 py-1.5 border-black">{{$bibliografi->call_number}}</div>
                                    <div class="border-r px-2 py-1.5 border-black w-24">{{$eks->bookstatus->name}}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-black">
                <div class="bg-teknik py-5 text-xl font-extrabold text-white text-center">
                    <p>Library Information</p>
                </div>
                <div class="p-4">
                    <p class="font-medium text-xl text-justify">Akses Katalog Publik Daring - Gunakan fasilitas pencarian untuk mempercepat penemuan data katalog
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Section 2 --}}
</div>






