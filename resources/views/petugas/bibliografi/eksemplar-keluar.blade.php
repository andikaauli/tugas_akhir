@extends('main.main')
@extends('petugas.bibliografi.sidebar')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Daftar Eksemplar Keluar
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center ">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.eksemplar') }}" method="GET">
                <div class="flex items-center">
                    <input type="search" name="search"
                        class="w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                        value="{{ request('search') }}" placeholder="Search" aria-label="Search"
                        aria-describedby="button-addon3" />
                    {{-- Btn Search --}}
                    <button type="submit"
                        class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
                        Cari
                    </button>
                </div>
            </form>
            {{-- End Btn Search --}}
        </div>
        {{-- End Search Bar --}}
    </div>
    {{-- End Section 2 --}}
       {{-- Section 3 --}}
       <div class="flex mb-4">
           <table class="table-auto w-full">
              <thead class="p-3 border-y border-solid border-gray-200">
                 <tr class="text-sm">
                    <th class="text-left p-3">KODE EKSEMPLAR</th>
                    <th class="text-left p-3">ID ANGGOTA</th>
                    <th class="text-left p-3">JUDUL</th>
                    <th class="text-left p-3">TANGGAL PINJAM</th>
                    <th class="text-left p-3">TERAKHIR KEMBALI</th>
                 </tr>
              </thead>
              <tbody>
                 <tr class="border-b border-solid text-sm font-medium border-gray-200">
                    <td class="p-3 w-40">B00013</td>
                    <td class="p-3 w-36">21120119130113</td>
                    <td class="p-3">
                             <p class="">Corruption and development : the anti-corruption campaignss</p>
                    </td>
                    <td class="p-3 w-36">2023-08-09</td>
                    <td class="p-3 w-40">2023-08-19</td>
                 </tr>
                 <tr class="border-b border-solid text-sm font-medium border-gray-200">
                    <td class="p-3 w-40">B00013</td>
                    <td class="p-3 w-36">21120119130113</td>
                    <td class="p-3">
                             <p class="">Corruption and development : the anti-corruption campaignss</p>
                    </td>
                    <td class="p-3 w-36">2023-08-09</td>
                    <td class="p-3 w-40">2023-08-19</td>
                 </tr>
              </tbody>
           </table>
       </div>
       {{-- End Section 3 --}}
    </div>
</div>
