{{-- Sidebar --}}
<aside id="logo-sidebar" class="fixed top-0 left-0 z-50 w-64 h-screen transition-transform -translate-x-full bg-white sm:translate-x-0 dark:bg-gray-800 " aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto bg-blue-500">
       <div class="flex w-64 bg-blue-700 bg-opacity-90 px-3 py-3">
           <div class="flex items-center ml-3">
             <div>
               <button type="button" class="flex text-sm bg-gray-800 rounded-full" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                 <img class="w-12 h-12 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
               </button>
             </div>
           </div>
           <div class="text-white pl-4">
               <h4>Admin</h4>
               <p class="font-bold">Pustakawan</p>
           </div>
       </div>
     {{-- Daftar Terkendali --}}
     <div class="">
        <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-4 pb-4">
           <p>DAFTAR TERKENDALI</p>
        </div>
        <ul class="space-y-2 pl-1 font-bold text-sm">
           <li class=" ">
              <a href="/publisher" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                 <span class="flex-1 ml-3 whitespace-nowrap">Penerbit</span>
              </a>
           </li>
           <li>
              <a href="/author" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                 <span class="flex-1 ml-3 whitespace-nowrap">Pengarang</span>
              </a>
           </li>
              </a>
           </li>
        </ul>
     </div>
     {{-- End Daftar Terkendali --}}
     {{-- Daftar Referensi --}}
     <div class="">
        <div class="text-white text-xs border-t border-white pl-4 pt-5 mt-2 pb-4">
           <p>DAFTAR REFERENSI</p>
        </div>
        <ul class="space-y-2 pl-1 font-bold text-sm">
           <li>
              <a href="/colltype" class="flex items-center p-2 text-white rounded-l-full hover:bg-white hover:bg-opacity-20 group">
                 <span class="flex-1 ml-3 whitespace-nowrap">Tipe Koleksi</span>
              </a>
           </li>
              </a>
           </li>
        </ul>
     </div>
     {{-- End Daftar Referensi --}}
    </div>
 </aside>
{{-- End Sidebar --}}
