@extends('main.main')
@extends('petugas.sirkulasi.sidebar')
{{-- End Sidebar --}}

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Sirkulasi
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     <div class="justify-center items-center">
        {{-- Search Bar --}}
       <div class="flex items-center p-4">
        <p class="mr-3 text-sm font-medium">Masukkan Kode Eksemplar</p>
        <input type="search" class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300" placeholder="Search" aria-label="Search" aria-describedby="button-addon3"/>
        {{-- Btn Search --}}
        <button class="px-3 h-10 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
            Pinjam
         </button>
         {{-- End Btn Search --}}
        </div>
        <div class="bg-white mb-6">
           <div class="p-4">
              <button class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Selesai Transaksi</button>
           </div>
           <div class="grid grid-cols-2 gap-0">
              <div class="">
                 <div class="flex border-b border-gray-200">
                    <div class="font-bold text-sm w-48 px-4 py-3">
                       <p>Nama Anggota</p>
                    </div>
                    <div class="font-normal text-sm px-4 py-3">
                       <p>abimanyu</p>
                    </div>
                 </div>
                 <div class="flex border-b border-gray-200">
                    <div class="font-bold text-sm w-48 px-4 py-3">
                       <p>Surel Anggota</p>
                    </div>
                    <div class="font-normal text-sm px-4 py-3">
                       <p>abndung@gmail.com</p>
                    </div>
                 </div>
                 <div class="flex border-b border-gray-200">
                    <div class="font-bold text-sm w-48 px-4 py-3">
                       <p>Tanggal Registrasi</p>
                    </div>
                    <div class="font-normal text-sm px-4 py-3">
                       <p>2023-02-22</p>
                    </div>
                 </div>
              </div>
              <div class="">
                 <div class="flex border-b border-gray-200">
                    <div class="font-bold text-sm w-48 px-4 py-3">
                       <p>ID Anggota</p>
                    </div>
                    <div class="font-normal text-sm px-4 py-3">
                       <p>21120119140123</p>
                    </div>
                 </div>
                 <div class="flex border-b border-gray-200">
                    <div class="font-bold text-sm w-48 px-4 py-3">
                       <p>Berlaku Hingga</p>
                    </div>
                    <div class="font-normal text-sm px-4 py-3">
                       <p>2024-02-22</p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        {{-- Tabs --}}
        <div class="container ">
            <div class="tab_box w-full flex items-center border-b border-gray-200 relative">
            <div class="p-3"></div>
              <button class="tab_btn w-44 text-sm font-bold px-4 py-3 actived border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Peminjaman</button>
              <button class="tab_btn w-44 text-sm font-bold px-4 py-3 border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Peminjaman Saat Ini</button>
              <button class="tab_btn w-44 text-sm font-bold px-4 py-3 border-slate-50 hover:border-gray-200 hover:text-blue-600 hover:rounded-t-md hover:border-x hover:border-t">Sejarah Peminjaman</button>
              <div class="line absolute top-11 left-6 bg-white w-44 h-1"></div>
            </div>
            <div class="content_box">
              <div class="content hidden bg-white animate-move duration-500 p-5 actived">
                <table class="table-auto w-full">
                    <thead class="p-3 border-b border-solid border-gray-200">
                       <tr class="text-sm">
                          <th class="text-left p-3">HAPUS</th>
                          <th class="text-left p-3">KODE EKSEMPLAR</th>
                          <th class="text-left p-3">JUDUL</th>
                          <th class="text-left p-3">TANGGAL PINJAM</th>
                          <th class="text-left p-3">TERAKHIR KEMBALI</th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr class="border-b border-solid text-sm font-medium border-gray-200">
                           <td class="p-3 w-18">
                            <button class="text-xs text-white font-bold bg-red-600 hover:bg-red-700 p-1.5 rounded">Hapus</button>
                           </td>
                          <td class="p-3 w-40">B00013</td>
                          <td class="p-3">
                                   <p class="">Corruption and development : the anti-corruption campaignss</p>
                          </td>
                          <td class="p-3 w-36">2023-08-09</td>
                          <td class="p-3 w-40">2023-08-19</td>
                       </tr>
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
                            <th class="text-left p-3">TANGGAL KEMBALI</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr class="border-b border-solid text-sm font-medium border-gray-200">
                             <td class="p-3 w-18">
                              <button class="text-xs text-white font-bold bg-blue-600 hover:bg-blue-500 p-1.5 rounded">Kembali</button>
                             </td>
                             <td class="p-3 w-18">
                              <button class="text-xs text-white font-bold bg-green-500 hover:bg-green-600 p-1.5 rounded">Perpanjang</button>
                             </td>
                            <td class="p-3 w-40">B00013</td>
                            <td class="p-3">
                                     <p class="">Corruption and development : the anti-corruption campaignss</p>
                            </td>
                            <td class="p-3 w-32">Reference</td>
                            <td class="p-3 w-36">2023-08-09</td>
                            <td class="p-3 w-40">2023-08-19</td>
                         </tr>
                      </tbody>
                   </table>
                </div>
              </div>
              <div class="content_box">
                <div class="content hidden bg-white animate-move duration-500 p-5">
                  <table class="table-auto w-full">
                      <thead class="p-3 border-b border-solid border-gray-200">
                         <tr class="text-sm">
                            <th class="text-left p-3">KODE EKSEMPLAR</th>
                            <th class="text-left p-3">JUDUL</th>
                            <th class="text-left p-3">TANGGAL PINJAM</th>
                            <th class="text-left p-3">TERAKHIR KEMBALI</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr class="border-b border-solid text-sm font-medium border-gray-200">
                            <td class="p-3 w-40">B00013</td>
                            <td class="p-3">
                                     <p class="">Corruption and development : the anti-corruption campaignss</p>
                            </td>
                            <td class="p-3 w-36">2023-08-09</td>
                            <td class="p-3 w-40">2023-08-19</td>
                         </tr>
                      </tbody>
                   </table>
                </div>
              </div>
          </div>
          {{-- End Tabs --}}
          <script>
            const tabs= document.querySelectorAll('.tab_btn')
            const all_content= document.querySelectorAll('.content')

            tabs.forEach((tab, index)=> {
                tab.addEventListener('click', (e)=>{
                    tabs.forEach(tab=>{tab.classList.remove('actived')});
                    tab.classList.add('actived');

                    var line=document.querySelector('.line');
                line.style.width = e.target.offsetWidth + "px";
                line.style.left = e.target.offsetLeft + "px";

                all_content.forEach(content=>{content.classList.remove('actived')});
                all_content[index].classList.add('actived');
                })
            })
        </script>
    </div>
    </div>
</div>
