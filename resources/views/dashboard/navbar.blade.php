<nav class="fixed top-0 w-full bg-teknik">
    <div class="flex items-center justify-center shadow-md" id="navbar-default">
        <ul class="flex h-full w-full items-center justify-center">
          <li class="h-full">
            <div class="flex justify-center items-center py-3 px-4">
                <div class="">
                    <img src="/assets/undip.png" alt="">
                </div>
                <div class="py-3 px-2.5 ml-4 text-white ">
                    <p class="uppercase text-center text-base tracking-normal font-bold">perpustakaan fakultas teknik</p>
                    <p class="uppercase text-center text-xl font-extrabold">universitas diponegoro</p>
                </div>
            </div>
          </li>
          <li class="h-min">
            <div class=" flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300 hover:border-amber-600 hover:text-blue-500">
                <a href="/profil" class="h-25 w-full text-center flex items-center px-2 font-bold text-sm @yield('active-profil-navbar')">PROFIL</a>
            </div>
          </li>
          <li class="h-25">
           <div class="flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300 hover:border-amber-600 hover:text-blue-500 ">
                <a href="/koleksi" class="h-25 w-full text-center flex items-center px-2 font-bold text-sm @yield('active-cari-koleksi-navbar')">CARI KOLEKSI</a>
           </div>
         </li>
         <li class="h-25">
           <div class="flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300 hover:border-amber-600 hover:text-blue-500">
               <a href="/layanan" class="h-25 w-full text-center flex items-center px-2 font-bold text-sm @yield('active-layanan-navbar')">LAYANAN</a>
           </div>
         </li>
         <li class="h-25">
           <div class="flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300 hover:border-amber-600 hover:text-blue-500">
               <a href="/keanggotaan" class="h-25 w-full text-center flex items-center px-2 font-bold text-sm @yield('active-keanggotaan-navbar')">KEANGGOTAAN</a>
           </div>
         </li>
         <li class="h-25">
           <div class="flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300 hover:border-amber-600 hover:text-blue-500 ">
               <a href="/absen" class="h-25 w-full text-center flex items-center px-2 font-bold text-sm @yield('active-absen-navbar')">ABSEN PENGUNJUNG</a>
           </div>
         </li>
         <li class="h-25">
           <div class="flex h-25 px-4 border-b-4 text-white border-teknik  items-center hover:ease-in-out hover:duration-300">
               <a href="/login" class="px-4 py-4 rounded-md bg-amber-600 hover:bg-blue-500 text-center flex items-center font-bold hover:font-extrabold text-sm @yield('active-login-navbar')">LOGIN ADMIN</a>
           </div>
         </li>
        </ul>
      </div>
</nav>
