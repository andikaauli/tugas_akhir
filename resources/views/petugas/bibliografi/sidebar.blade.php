{{-- Sidebar --}}
<aside id="logo-sidebar" class="fixed top-0 left-0 z-20 w-64 h-screen transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 " aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto bg-blue-500">
       <div class="flex w-64 bg-blue-700 bg-opacity-90 px-3 py-3">
           <div class="flex items-center ml-3">
             <div>
               <button type="button" class="flex text-sm bg-gray-800 rounded-full" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                 <img class="w-12 h-12 rounded-full" src="assets/blank.png" alt="user photo">
               </button>
             </div>
           </div>
           <div class="text-white pl-4">
               <h4>Admin</h4>
               <p class="font-bold">Pustakawan</p>
           </div>
       </div>
     {{-- Bibliografi --}}
     <div class="">
        <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-4 pb-4">
           <p>BIBLIOGRAFI</p>
        </div>
        <ul class="space-y-2 pl-1 font-bold text-sm">
           <li class=" ">
              <a href="/bibliografi" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-bibliografi')">
                 <span class="flex-1 ml-3 whitespace-nowrap">Daftar Bibliografi</span>
              </a>
           </li>
           <li>
              <a href="/bibliografi/create" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-create-bibliografi')">
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
              <a href="/eksemplar" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-eksemplar')">
                 <span class="flex-1 ml-3 whitespace-nowrap">Daftar Eksemplar</span>
              </a>
           </li>
           <li>
              <a href="/eksemplar-keluar" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-eksemplar-keluar')">
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
