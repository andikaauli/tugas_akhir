@extends('main.main')
@extends('petugas.inventarisasi.sidebar')
@section('active-inventarisasi-aktif', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

{{-- Content --}}
<div class="sm:ml-64">
    <div class="mt-18">
        {{-- Section 1 --}}
        <div class="px-4 pt-4 flex my-5">
            <div class="flex items-center">
                <p class="text-3xl text-black font-bold">
                    Inventarisasi
                </p>
            </div>
        </div>
        {{-- End Section 1 --}}
        {{-- Search Bar --}}
        <div class="p-4 bg-blue-100">
            <p class="mr-3 mb-2 font-medium">Kode Eksemplar</p>
            <form class="flex">
                <input type="text" id="input-item-code"
                    class="relative w-80 m-0 mr-1 mb-3 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                    placeholder="" aria-label="Search" aria-describedby="button-addon3" />
                {{-- Btn Filter --}}
                <button id="button-ubah-status"
                    class="px-3 h-10 rounded text-white text-sm font-semibold bg-blue-600 hover:bg-blue-500">
                    Ubah Status
                </button>
                {{-- End Btn Filter --}}
            </form>
        </div>
        {{-- End Search Bar --}}
        {{-- Section 2 --}}
        <div class="py-8 px-4 mb-4">
            {{-- Search Bar --}}
            <div class="flex items-center">
                <p class="mr-3">Cari</p>
                <form class="m-0" action="{{ route('client.active-inventarisasi') }}" method="GET">
                    <div class="flex items-center">
                        <input type="search" name="searchStock"
                            class="w-80 m-0 mr-1 block rounded border border-solid border-gray-400 focus:ring focus:ring-blue-300"
                            value="{{ request('searchStock') }}" placeholder="Search" aria-label="Search"
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
        <div class="flex mb-4 ">
            <table class="table-auto w-full">
                <thead class="p-3 border-y border-solid border-gray-400">
                    <tr class="text-sm">
                        <th class="text-left p-3">KODE EKSEMPLAR</th>
                        <th class="text-left p-3">JUDUL</th>
                        {{-- <th class="text-left p-3">TIPE KOLEKSI</th> --}}
                        <th class="text-left p-3">KLASIFIKASI</th>
                        <th class="text-left p-3">STATUS</th>
                    </tr>
                </thead>
                <tbody id="list-stocktakeitem">
                    <tr class="border-b border-solid border-gray-400">
                        <td class="p-3 leading-6 w-44"></td>
                        <td class="p-3 leading-6"></td>
                        <td class="p-3 leading-6 W-46"></td>
                        {{-- <td class="p-3 leading-6 w-28">Reference</td> --}}
                        <td class="p-3 leading-6 w-20"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- End Section 3 --}}
    </div>
</div>

<script>
    const stockTakeItemContainer = document.getElementById('list-stocktakeitem');

    const idInven = @json($inventarisasiId);

    // console.log(idInven);
    setInterval(() => {
    fetch(@json(route('show.stockopname', ['id' => $inventarisasiId])) + "?" + new URLSearchParams({
            searchStock: @json($searchStock) ?? ''
        }))
        .then(response => response.json())
        .then(data => {
            const stockTakeItem = data.stocktakeitem.filter((item) => item.book_status_id == 2)


            if (stockTakeItem.length > 0) {
                stockTakeItemContainer.innerHTML = ''
                stockTakeItem.forEach((item) => {
                    const tr = document.createElement('tr')
                    tr.classList.add('border-b', 'border-solid', 'border-gray-400')

                    const eksemplar = item.eksemplar

                    // Cara 1
                    const itemCode = document.createElement('td')
                    itemCode.classList.add('p-3', 'leading-6', 'w-44')
                    itemCode.textContent = eksemplar.item_code

                    const title = document.createElement('td')
                    title.classList.add('p-3', 'leading-6')
                    title.textContent = eksemplar.biblio.title

                    const classification = document.createElement('td')
                    classification.classList.add('p-3', 'leading-6', 'W-46')
                    classification.textContent = eksemplar.biblio.classification

                    const status = document.createElement("td")
                    status.classList.add('p-3', 'leading-6', 'w-20')
                    status.textContent = item.bookstatus.name

                    tr.appendChild(itemCode)
                    tr.appendChild(title)
                    tr.appendChild(classification)
                    tr.appendChild(status)

                    stockTakeItemContainer.appendChild(tr)

                    // Cara 2
                    // const string = `
                    //     <tr class="border-b border-solid border-gray-400">
                    //     <td class="p-3 leading-6 w-44">${eksemplar.item_code}</td>
                    //     <td class="p-3 leading-6">${eksemplar.biblio.title}</td>
                    //     <td class="p-3 leading-6 W-46">${eksemplar.biblio.classification}</td>
                    //     <td class="p-3 leading-6 w-20">${item.bookstatus.name}</td>
                    // </tr>`

                    //     stockTakeItemContainer.innerHTML += string
                });

            }
            // stockTakeItemContainer.appendChild(tr)
        })
    }, 1000);

    const btnUbahStatus = document.getElementById('button-ubah-status');
    const inputItemCode = document.getElementById('input-item-code');

    btnUbahStatus.addEventListener('click', function() {
        const itemCode = inputItemCode.value

        fetch(@json(route('button.stocktakeitem')), {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    item_code: itemCode,
                    stock_opname_id: idInven
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw response;
                }
                inputItemCode.value = ''
            })
            .catch(error => {
                error.json().then((body) => {
                    //Here is already the payload from API
                    alert(body.message);
                })
                // alert(error)
            })
    })
</script>
