{{-- Sidebar --}}
<aside id="logo-sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 " aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto bg-blue-500">
       <div class="flex w-64 bg-blue-700 bg-opacity-90 px-3 py-3">
           <div class="flex items-center ml-3">
             <div>
               <button type="button" class="flex text-sm bg-gray-800 rounded-full" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                 <img class="w-12 h-12 rounded-full" src="{{ Auth::user()->image }}" alt="user photo">
               </button>
             </div>
           </div>
           <div class="text-white pl-4">
               <h4>{{ Auth::user()->name }}</h4>
               <p class="font-bold">Pustakawan</p>
           </div>
       </div>
     {{-- Sirkulasi --}}
     <div class="">
        <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-4 pb-4">
           <p>SIRKULASI</p>
        </div>
        <ul class="space-y-2 pl-1 font-bold text-sm">
           <li class=" ">
              <a href="{{route('client.loan-start')}}" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-mulai-sirkulasi')">
                 <span class="flex-1 ml-3 whitespace-nowrap">Mulai Sirkulasi</span>
              </a>
           </li>
           <li>
              <a href="{{route('client.fastreturn')}}" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-pengembalian-kilat')">
                 <span class="flex-1 ml-3 whitespace-nowrap">Pengembalian Kilat</span>
              </a>
           </li>
           <li>
            <a href="{{route('client.loan-history')}}" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-sejarah-peminjaman')">
               <span class="flex-1 ml-3 whitespace-nowrap">Sejarah Peminjaman</span>
            </a>
         </li>
         <li>
            <a href="{{route('client.loan-overdue')}}" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group @yield('active-daftar-keterlambatan')">
               <span class="flex-1 ml-3 whitespace-nowrap">Daftar Keterlambatan</span>
            </a>
         </li>
        </ul>
     </div>
     {{-- End Sirkulasi --}}
    </div>
 </aside>
{{-- End Sidebar --}}
