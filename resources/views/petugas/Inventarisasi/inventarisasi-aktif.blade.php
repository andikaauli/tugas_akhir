@extends('main.main')
@section('active-inventarisasi-aktif', 'bg-white bg-opacity-30')
@section('active-inventarisasi-navbar', 'text-blue-500 border-blue-500')
{{-- End Sidebar --}}

@section('content')
{{-- Content --}}
<div class="sm:ml-64">
    @include('petugas.inventarisasi.sidebar')
    <div class="mt-18">
        {{-- Section 1 --}}
        <div class="px-4 pt-4 flex my-5">
            <div class="flex items-center">
                <p class="text-3xl text-black font-bold">
                    Stock Opname
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
                <button id="button-ubah-status" type="button"
                    class="px-3 h-10 rounded text-white text-sm font-semibold bg-blue-600 hover:bg-blue-500">
                    Ubah Status
                </button>
                {{-- End Btn Filter --}}
            </form>
            <p id='messagecode'class="mr-3 mb-2 font-medium"></p>
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
                <tr>
                    <td>
                        <table class="table-auto w-full">
                            <tr class="text-sm p-3 border-y border-solid border-gray-400">
                                <th class="text-left p-3 w-44">KODE EKSEMPLAR</th>
                                <th class="text-left p-3">JUDUL</th>
                                <th class="text-left p-3 W-46">KLASIFIKASI</th>
                                {{-- <th class="text-left p-3">TIPE KOLEKSI</th> --}}
                                <th class="text-left p-3 w-20">STATUS</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="max-h-96 overflow-auto">
                            <table class="table-auto w-full" id="list-stocktakeitem">
                                <tr class="border-b border-solid border-gray-400">
                                    <td class="p-3 leading-6 w-44"></td>
                                    <td class="p-3 leading-6"></td>
                                    <td class="p-3 leading-6 W-46"></td>
                                    {{-- <td class="p-3 leading-6 w-28">Reference</td> --}}
                                    <td class="p-3 leading-6 w-20"></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        {{-- End Section 3 --}}
    </div>
</div>

<script>
    // const stockTakeItemContainer = document.getElementById('list-stocktakeitem');

    // const idInven = @json($inventarisasiId);

    // // console.log(idInven);
    // setInterval(() => {
    // fetch(@json(route('show.stockopname', ['id' => $inventarisasiId])) + "?" + new URLSearchParams({
    //         searchStock: @json($searchStock) ?? ''
    //     }))
    //     .then(response => response.json())
    //     .then(data => {
    //         const stockTakeItem = data.stocktakeitem.filter((item) => item.book_status_id == 2)


    //         if (stockTakeItem.length > 0) {
    //             stockTakeItemContainer.innerHTML = ''
    //             stockTakeItem.forEach((item) => {
    //                 const tr = document.createElement('tr')
    //                 tr.classList.add('border-b', 'border-solid', 'border-gray-400')

    //                 const eksemplar = item.eksemplar

    //                 // Cara 1
    //                 const itemCode = document.createElement('td')
    //                 itemCode.classList.add('p-3', 'leading-6', 'w-44')
    //                 itemCode.textContent = eksemplar.item_code

    //                 const title = document.createElement('td')
    //                 title.classList.add('p-3', 'leading-6')
    //                 title.textContent = eksemplar.biblio.title

    //                 const classification = document.createElement('td')
    //                 classification.classList.add('p-3', 'leading-6', 'W-46')
    //                 classification.textContent = eksemplar.biblio.classification

    //                 const status = document.createElement("td")
    //                 status.classList.add('p-3', 'leading-6', 'w-20')
    //                 status.textContent = item.bookstatus.name

    //                 tr.appendChild(itemCode)
    //                 tr.appendChild(title)
    //                 tr.appendChild(classification)
    //                 tr.appendChild(status)

    //                 stockTakeItemContainer.appendChild(tr)

    //             });

    //         }
    //         // stockTakeItemContainer.appendChild(tr)
    //     })
    // }, 1000);

    const stockTakeItemContainer = document.getElementById('list-stocktakeitem');
    const idInven = @json($inventarisasiId);

    setInterval(() => {
        fetch(@json(route('show.stockopname', ['id' => $inventarisasiId])) + "?" + new URLSearchParams({
                searchStock: @json($searchStock) ?? ''

            }))
            .then(response => response.json())
            .then(data => {

                const stockTakeItem = data.stocktakeitem.filter((item) => item.book_status_id == 2)

                if (stockTakeItem.length > 0) {
                    stockTakeItemContainer.innerHTML = '';
                    stockTakeItem.forEach((item) => {
                        const tr = document.createElement('tr');
                        tr.classList.add('border-b', 'border-solid', 'border-gray-400');

                        const eksemplar = item.eksemplar;

                        // Create table cells efficiently
                        const [itemCode, title, classification, status] = [
                            'item_code',
                            'title',
                            'classification',
                            'name',
                        ].map(field => {
                            const td = document.createElement('td');
                            td.classList.add('p-3', 'leading-6');
                            td.textContent = item[field];
                            return td;
                        });

                        itemCode.classList.add('w-44');
                        classification.classList.add('W-46');
                        status.classList.add('w-20');

                        tr.append(itemCode, title, classification, status);
                        stockTakeItemContainer.appendChild(tr);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                // Handle errors appropriately, e.g., display an error message
            });
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
                response.json().then((body) => {
                    //Here is already the payload from API
                    document.getElementById('messagecode').innerHTML = body.message
                })
            })
            .catch(error => {
                error.json().then((body) => {
                    //Here is already the payload from API
                    // alert(body.message);
                    document.getElementById('messagecode').innerHTML = body.message
                })
                // alert(error)
            })
    })
</script>
@endsection
