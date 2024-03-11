<nav class="fixed top-0 z-10 w-full bg-white ">
    <div class="flex shadow-md" id="navbar-default">
        <ul class="flex h-18 w-full ml-64 items-center font-medium p-4 md:p-0 mt-4 md:mt-0 ">
            {{-- @dd(Request::is('beranda')) --}}
            <li class="h-full ">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-beranda-navbar')">
                    <a href="/beranda"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Beranda</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-bibliografi-navbar')">
                    <a href="/bibliografi"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Bibliografi</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-sirkulasi-navbar')">
                    <a href="{{route('client.loan-start')}}"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Sirkulasi</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-keanggotaan-navbar')">
                    <a href="/anggota"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Keanggotaan</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-daftarTerkendali-navbar')">
                    <a href="/publisher"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Daftar Terkendali</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500 @yield('active-inventarisasi-navbar')">
                    <a href="/inventarisasi"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Stock Opname</a>
                </div>
            </li>
            <li class="h-full">
                <div
                    class="flex h-full px-4 border-b-3 text-black border-white  items-center hover:ease-in-out hover:duration-300 hover:border-blue-500 hover:text-blue-500">
                    <a href="/logout"
                        class="h-full w-full text-center flex items-center px-2 font-bold text-sm">Keluar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
