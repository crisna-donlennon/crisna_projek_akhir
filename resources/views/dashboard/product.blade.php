@extends('dashboard.main')

@section('header')
<div class="flex justify-between">
    <p class="text-lg flex w-fit font-semibold">
        PRODUCTS
    </p>
    <a href="/dashboard/create-product">
        <button type="button" class="flex text-gray-500 hover:text-[#0A2974]">
            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <p class="ml-2 pt-[1px] font-medium">
                Tambahkan Produk
            </p>
        </button>
    </a>
</div>
@endsection

@section('content') 
    <div class="relative overflow-x-auto">
        <table id="product-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-4 py-2">
                        Nama
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Deskripsi
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Type
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Stok
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Berat
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Harga
                    </th>
                    <th scope="col" class="px-4 py-2">
                        Gambar
                    </th>
                    <th scope="col" class="py-2 flex justify-center">
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="odd:bg-slate-50 odd:dark:bg-gray-900 even:bg-slate-100 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-4 py-2 text-gray-900  font-bold break text-xs w-56" scope="row">
                            {{ $product->nama_product }}
                        </th>
                        <td class="px-4 py-2 break">
                            {{ $product->deskripsi }}
                        </td>
                        <td class="px-4 py-2 break uppercase">
                            <p class="w-fit px-3 flex items-center">
                                {{ $product->type->nama_type }}
                            </p>
                        </td>
                        <td class="px-4 py-2">
                            <p class="w-fit px-3 flex items-center">
                                {{ $product->stok }}
                            </p>
                        </td>
                        <td class="px-4 py-2">
                            <p class="w-fit px-3 flex items-center">
                                {{ $product->berat }} gram
                            </p>
                        </td>
                        <td class="px-4 py-2">
                            <p class="w-fit px-3 flex items-center">
                                Rp. {{ number_format($product->harga) }}
                            </p>
                        </td>
                        <td class="px-4 py-2 p-1 w-10 h-20">
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="" class="w-full h-full object-cover">
                        </td>
                        <td class="px-4 py-2">
                            <a href="{{ url('/product/' . $product->id . '/edit') }}" class="w-fit px-3 flex justify-center align-middle items-center cursor-pointer font-medium hover:brightness-95 uppercase rounded-md hover:text-[#0A2974]">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTables
        $(document).ready( function () {
            $('#product-table').DataTable({
                "order": [[0, 1, 2, 3, 4, 5, "asc"]], // Sort by the third column (Type) in ascending order
                "columnDefs": [
                    { "orderable": false, "targets": [6, 7] } // Disable sorting for other columns
                ]
            });
        });
    </script>

@endsection
