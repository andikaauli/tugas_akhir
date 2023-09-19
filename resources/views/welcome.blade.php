<!DOCTYPE html>
<html lang="eng" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="<?php echo asset('style.css')?>">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>

        </style>

        <style>
            body {
                font-family: 'quicksand';
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-slate-50">
{{-- Navbar --}}
<nav class="fixed top-0 z-50 w-full bg-white ">
      <div class="flex self-stretch justify-items-start items-start h-full">
        <div class="flex w-64 bg-blue-700 bg-opacity-90 px-3 py-3">
            <div class="flex items-center ml-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    Neil Sims
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    neil.sims@flowbite.com
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Earnings</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="text-white pl-4">
                <h4>Admin</h4>
                <p class="font-bold">Pustakawan</p>
            </div>
        </div>
        <div class="flex self-stretch items-start justify-self-stretch shadow-md" id="navbar-default">
            <ul class="flex h-full w-full items-center font-medium p-4 md:p-0 mt-4 md:mt-0 ">
              <li class="h-full ">
                <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                    <a href="#" class="block px-2 font-bold text-sm">Beranda</a>
                </div>
              </li>
              <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                    <a href="#" class="block px-2 font-bold text-sm">Bibliografi</a>
               </div>
             </li>
             <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                   <a href="#" class="block px-2 font-bold text-sm">Sirkulasi</a>
               </div>
             </li>
             <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                   <a href="#" class="block px-2 font-bold text-sm">Keanggotaan</a>
               </div>
             </li>
             <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                   <a href="#" class="block px-2 font-bold text-sm">Daftar Terkendali</a>
               </div>
             </li>
             <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                   <a href="#" class="block px-2 font-bold text-sm">Inventarisasi</a>
               </div>
             </li>
             <li class="h-full">
               <div class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                   <a href="#" class="block px-2 font-bold text-sm">Keluar</a>
               </div>
             </li>
            </ul>
          </div>
      </div>
</nav>
{{-- End Navbar --}}
{{-- Sidebar --}}
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 " aria-label="Sidebar">
     <div class="h-full pb-4 overflow-y-auto bg-blue-500">
      {{-- Bibliografi --}}
      <div class="">
         <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-8 pb-4">
            <p>BIBLIOGRAFI</p>
         </div>
         <ul class="space-y-2 pl-1 font-bold text-sm">
            <li class=" ">
               <a href="#" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Daftar Bibliografi</span>
               </a>
            </li>
            <li>
               <a href="#" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Tambah Bibliografi Baru</span>
               </a>
            </li>
               </a>
            </li>
         </ul>
      </div>
      {{-- End Bibliografi --}}
      {{-- Eksemplar --}}
      <div class="">
         <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-2 pb-4">
            <p>EKSEMPLAR</p>
         </div>
         <ul class="space-y-2 pl-1 font-bold text-sm">
            <li class=" ">
               <a href="#" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Daftar Eksemplar</span>
               </a>
            </li>
            <li>
               <a href="#" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                  <span class="flex-1 ml-3 whitespace-nowrap">Daftar Eksemplar Keluar</span>
               </a>
            </li>
               </a>
            </li>
         </ul>
      </div>
      {{-- End Eksemplar --}}
     </div>
  </aside>
{{-- End Sidebar --}}

{{-- Content --}}
  <div class="sm:ml-64">
     <div class="mt-18">
      {{-- Section 1 --}}
        <div class="flex my-5 p-4">
           <div class="flex items-center  bg-gray-50">
              <p class="text-3xl text-black font-bold">
                 Bibliografi
              </p>
           </div>
        </div>
      {{-- End Section 1 --}}
      {{-- Section 2 --}}
        <div class="py-8 px-4 mb-4">
         {{-- Search Bar --}}
            <div class="flex items-center ">
               <p class="mr-3">Cari</p>
               <input type="search" class="relative w-80 m-0 mr-1 block rounded border border-solid border-gray-400 bg-transparent "
                  placeholder="Search"
                  aria-label="Search"
                  aria-describedby="button-addon3"/>
               {{-- Dropdown --}}
               <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded border border-solid border-gray-400 text-sm px-5 py-2.5 mr-1 text-center inline-flex items-center" type="button">
                  Dropdown button
                  <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
               </button>
            <!-- Dropdown menu -->
               <div id="dropdown" class="z-10 hidden border border-solid border-gray-400 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                  <ul class="py-2 text-sm" aria-labelledby="dropdownDefaultButton">
                     <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                     </li>
                     <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                     </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                     </li>
                     <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                     </li>
                  </ul>
               </div>
               {{-- End Dropdown --}}
               {{-- Btn Search --}}
               <button class="px-3 py-2 rounded bg-gray-500 text-white text-sm font-semibold hover:bg-blue-500">
                  Cari
               </button>
               {{-- End Btn Search --}}
            </div>
        </div>
        {{-- End Section 2 --}}
        {{-- Section 3 --}}
        <div class="flex mb-4 py-3 px-4 ">
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Hapus Data Terpilih</button>
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tandai Semua</button>
            <button class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Hilangkan Semua Tanda</button>
        </div>
        {{-- End Section 3 --}}
        {{-- Section 4 --}}
        <div class="flex items-center mb-4 bg-gray-200">
            <table class="table-auto">
               <thead class="p-3 border-y border-solid border-gray-400">
                  <tr>
                     <th class="p-3">HAPUS</th>
                     <th class="p-3">SUNTING</th>
                     <th class="flex items-start p-3">JUDUL</th>
                     <th class="p-3">ISBN/ISSN</th>
                     <th class="p-3">SALIN</th>
                     <th class="p-3">PERUBAHAN TERAKHIR</th>
                  </tr>
               </thead>
               <tbody>
                  <tr class="border-b border-solid border-gray-400">
                     <td class="p-3">
                        <div class="flex items-center justify-center">
                           <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4  border-black rounded">
                       </div>
                     </td>
                     <td class="p-3">
                        <a href="#" class="flex items-center justify-center">
                           <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <rect width="24" height="24" fill="black"/>
                              <path d="M16 4L14 6L18 10L20 8L16 4ZM12 8L4 16V20H8L16 12L12 8Z" fill="white"/>
                           </svg>
                        </a>
                     </td>
                     <td class="p-3">
                        <div class="flex">
                           <div class="bg-gray-500 w-12 h-16">

                           </div>
                           <div class="ml-4">
                              <p class="text-sm font-medium">Ajax : creating Web pages with asynchronous JavaScript and XML</p>
                              <p class="text-sm font-medium text-gray-500">Douglas, Korry - Douglas, Susan
                              </p>
                           </div>
                        </div>
                     </td>
                     <td class="p-3">12345678</td>
                     <td class="p-3">3</td>
                     <td class="p-3">2023-02-22 19:09:07</td>
                  </tr>
               </tbody>
            </table>
        </div>
        {{-- End Section 4 --}}
        {{-- Section 5 --}}
        <div>

        </div>
        {{-- End Section 5 --}}
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
                           <p>Tipe Keanggotaan</p>
                        </div>
                        <div class="font-normal text-sm px-4 py-3">
                           <p>Standar</p>
                        </div>
                     </div>
                     <div class="flex border-b border-gray-200">
                        <div class="font-bold text-sm w-48 px-4 py-3">
                           <p>Nama Anggota</p>
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
@vite('resources/js/app.js')
    </body>
</html>
