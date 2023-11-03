@extends('main.main')
@extends('petugas.daftar-terkendali.sidebar')
@section('active-tipeKoleksi', 'bg-white bg-opacity-30')
@section('active-daftarTerkendali-navbar', 'text-blue-500 border-blue-500')

{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
        @method('DELETE')
        @csrf
     {{-- Section 1 --}}
     <div class="px-4 pt-4 flex justify-between my-5">
        <div>
            <p class="text-3xl text-black font-bold">
               Tipe Koleksi
            </p>
        </div>
        <div class="flex">
            <a href="colltype/create" class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tambah Tipe Koleksi</a>
        </div>
   </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.colltypes') }}" method="GET">
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
    </div>
    {{-- End Section 2 --}}
    {{-- Section 3 --}}
    <form action="{{ route('client.delete-colltypes') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex mb-4 py-3 px-4">
            <button type="submit"
                class="rounded px-3 py-2 text-white text-sm font-bold bg-red-600 hover:bg-red-800 mr-2">Hapus Data
                Terpilih</button>
            <button type="button" id="select-all"
                class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500 mr-2">Tandai
                Semua</button>
            <button type="button" id="deselect-all"
                class="rounded px-3 py-2 text-white text-sm font-bold bg-gray-500 hover:bg-blue-500">Hilangkan Semua
                Tanda</button>
            </div>
           {{-- End Section 3 --}}
           {{-- Section 4 --}}
           <div class="flex mb-4 ">
               <table class="table-auto w-full">
                  <thead class="p-3 border-y border-solid border-gray-400">
                     <tr class="text-sm">
                        <th class="text-left p-3">HAPUS</th>
                        <th class="text-left p-3">SUNTING</th>
                        <th class="text-left p-3">TIPE KOLEKSI</th>
                        <th class="text-left p-3">PERUBAHAN TERAKHIR</th>
                     </tr>
                  </thead>
                  <tbody>
                    @if ($colltypes)
                    @foreach ($colltypes as $colltype)
                    <tr class="border-b border-solid border-gray-400">
                       <td class="p-3 w-16">
                          <div class="flex items-center justify-center">
                             <input id="default-checkbox" name="deletedColltypes[]" value="{{$colltype->id}}" type="checkbox" value="" class="w-4 h-4  border-black rounded">
                         </div>
                       </td>
                       <td class="p-3 w-20">
                          <a href="{{ route('client.edit-colltypes', ['id' => $colltype->id]) }}" class="flex items-center justify-center">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="black"/>
                                <path d="M16 4L14 6L18 10L20 8L16 4ZM12 8L4 16V20H8L16 12L12 8Z" fill="white"/>
                             </svg>
                          </a>

                       </td>
                       <td class="p-3">{{$colltype->title}}</td>
                       <td class="p-3 w-46">{{ Carbon\Carbon::createFromTimestamp(strtotime($colltype->updated_at)) }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <th class="pt-6 pb-3 text-center" colspan="4">TIDAK ADA DATA</th>
                    </tr>
                    @endif
                  </tbody>
               </table>
           </div>
            <div class="flex justify-end">
            {{$colltypes->withQueryString()->links('pagination.custom')}}
            </div>
           {{-- End Section 4 --}}
        </form>
    </div>
</div>
<script>
    const selectAllBtn = document.getElementById('select-all');
    const deselectAllBtn = document.getElementById('deselect-all');

    selectAllBtn.addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(check => {
            check.checked = true
        });
    })

    deselectAllBtn.addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(check => {
            check.checked = false
        });
    })
</script>
