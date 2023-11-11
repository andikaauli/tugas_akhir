{{-- Sidebar --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 "
    aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto bg-blue-500">
        <div class="flex w-64 bg-blue-700 bg-opacity-90 px-3 py-3">
            <div class="flex items-center ml-3">
                <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full" aria-expanded="false"
                        data-dropdown-toggle="dropdown-user">
                        <img class="w-12 h-12 rounded-full"
                            src="assets/blank.png" alt="user photo">
                    </button>
                </div>
            </div>
            <div class="text-white pl-4">
                <h4>{{ Auth::user()->name }}</h4>
                <p class="font-bold">Pustakawan</p>
            </div>
        </div>
        {{-- Bibliografi --}}
        <div class="">
            <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-4 pb-4">
                <p>DAFTAR TERKENDALI</p>
            </div>
            <ul class="space-y-2 pl-1 font-bold text-sm">
                @if (!session()->get('active_inventarisasi'))
                    <li class=" ">
                        <a href="/inventarisasi/rekaman"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-rekaman-inventarisasi')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Rekaman Inventarisasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="/inventarisasi/inisialisasi"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-insialisasi')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Inisialisasi</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="/inventarisasi/aktif"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-inventarisasi-aktif')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Inventarisasi Aktif</span>
                        </a>
                    </li>
                    <li>
                        <a href="/inventarisasi/laporan"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-laporan-inventarisasi')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Laporan Inventarisasi</span>
                        </a>
                    </li>
                    <li>
                        <a href="/inventarisasi/eksemplar-hilang"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-eksemplar-hilang')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Eksemplar Hilang Saat Ini</span>
                        </a>
                    </li>
                    <li>
                        <a href="/inventarisasi/end"
                            class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-end-inventarisasi')">
                            <span class="flex-1 ml-3 whitespace-nowrap">Selesaikan Inventarisasi</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        {{-- End Bibliografi --}}

    </div>
</aside>
{{-- End Sidebar --}}
