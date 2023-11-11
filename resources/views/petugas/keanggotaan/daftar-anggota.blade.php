@extends('main.main')
@extends('petugas.keanggotaan.sidebar')
@section('active-anggota', 'bg-white bg-opacity-30')
@section('active-keanggotaan-navbar', 'text-blue-500 border-blue-500')
{{-- @dd($members) --}}
{{-- Content --}}
 <div class="sm:ml-64">
    <div class="mt-18">
        @method('DELETE')
        @csrf
     {{-- Section 1 --}}
       <div class="px-4 pt-4 flex my-5">
          <div class="flex items-center">
             <p class="text-3xl text-black font-bold">
                Keanggotaan
             </p>
          </div>
       </div>
     {{-- End Section 1 --}}
     {{-- Section 2 --}}
     <div class="py-8 px-4 mb-4">
        {{-- Search Bar --}}
        <div class="flex items-center">
            <p class="mr-3">Cari</p>
            <form class="m-0" action="{{ route('client.member') }}" method="GET">
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
       <form action="{{ route('client.delete-member') }}" method="POST">
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
            <div class="flex mb-4">
                <table class="table-auto w-full">
                   <thead class="p-3 border-y border-solid border-gray-400">
                      <tr class="text-sm">
                         <th class="text-left p-3">HAPUS</th>
                         <th class="text-left p-3">SUNTING</th>
                         <th class="text-left p-3">ID ANGGOTA</th>
                         <th class="text-left p-3">NAMA ANGGOTA</th>
                         <th class="text-left p-3">SUREL</th>
                         <th class="text-left p-3">TERAKHIR DIUBAH</th>
                      </tr>
                   </thead>
                   <tbody>
                    @foreach ($members as $member)
                    {{-- @dd($member) --}}
                    <tr class="border-b border-solid border-gray-400">
                       <td class="p-3 w-16">
                          <div class="flex items-center justify-center">
                             <input id="default-checkbox"  name="deletedMember[]" type="checkbox" value="{{$member->id}}" class="w-4 h-4  border-black rounded">
                         </div>
                       </td>
                       <td class="p-3 w-20">
                          <a href="{{ route('client.edit-member', ['id' => $member->id]) }}" class="flex items-center justify-center">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="black"/>
                                <path d="M16 4L14 6L18 10L20 8L16 4ZM12 8L4 16V20H8L16 12L12 8Z" fill="white"/>
                             </svg>
                          </a>
                       </td>
                       <td class="p-3 font-medium w-40">{{$member->nim}}</td>
                       <td class="p-3">
                             <div class="flex">
                                <img src="{{$member->image ?? 'assets/blank.png'}}" class="bg-gray-200 w-16 h-16 rounded-md mr-4"></img>
                                <div class="">
                                  <div class="mb-1"><p class="font-medium">{{$member->name}}</p></div>
                                  <div class="flex items-center">
                                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M12.341 10.0473L9.40769 10.6157C7.42636 9.62121 6.20246 8.47887 5.49019 6.69818L6.0386 3.75643L5.00194 1H2.33026C1.52714 1 0.894704 1.66368 1.01465 2.45779C1.3141 4.44028 2.19702 8.03476 4.77792 10.6157C7.48826 13.326 11.3919 14.5021 13.5403 14.9696C14.37 15.1502 15.1059 14.5029 15.1059 13.6539V11.1009L12.341 10.0473Z" fill="black" stroke="black" stroke-width="1.64309" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                      <p class="font-medium ml-1">
                                        {{$member->phone}}</p>
                                  </div>
                                  <div class="flex items-center">
                                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M10.0002 1.66666C8.24354 1.66658 6.55788 2.3598 5.30953 3.59566C4.06119 4.83152 3.35106 6.51013 3.3335 8.26666C3.3335 12.8333 9.2085 17.9167 9.4585 18.1333C9.60944 18.2624 9.80154 18.3334 10.0002 18.3334C10.1988 18.3334 10.3909 18.2624 10.5418 18.1333C10.8335 17.9167 16.6668 12.8333 16.6668 8.26666C16.6493 6.51013 15.9391 4.83152 14.6908 3.59566C13.4425 2.3598 11.7568 1.66658 10.0002 1.66666ZM10.0002 10.8333C9.4233 10.8333 8.85939 10.6623 8.37975 10.3418C7.90011 10.0213 7.52627 9.56577 7.30551 9.03282C7.08476 8.49987 7.027 7.91343 7.13954 7.34765C7.25208 6.78187 7.52987 6.26217 7.93777 5.85427C8.34567 5.44637 8.86537 5.16858 9.43115 5.05604C9.99693 4.9435 10.5834 5.00126 11.1163 5.22202C11.6493 5.44277 12.1048 5.81661 12.4253 6.29625C12.7458 6.77589 12.9168 7.3398 12.9168 7.91666C12.9168 8.69021 12.6095 9.43208 12.0626 9.97906C11.5156 10.526 10.7737 10.8333 10.0002 10.8333Z" fill="black"/>
                                      </svg>
                                      <p class="font-medium m-1">{{$member->address}}</p></div>
                                </div>
                             </div>
                       </td>
                       <td class="p-3 w-28">{{$member->email}}</td>
                       <td class="p-3 w-46">{{ Carbon\Carbon::createFromTimestamp(strtotime($member->updated_at))  }}</td>
                    </tr>
                    @endforeach
                    @if ($members->isEmpty())
                    <tr>
                        <td class="pt-6 pb-6 text-center border-b border-gray-400 text-red-600 font-semibold" colspan="6">Tidak Ada Data</td>
                    </tr>
                    @endif
                   </tbody>
                </table>
            </div>
            <div class="flex justify-end">
                {{$members->withQueryString()->links('pagination.custom')}}
                </div>
           </div>
       </form>


       {{-- End Section 3 --}}
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
