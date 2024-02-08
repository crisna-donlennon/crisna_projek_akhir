@extends('layouts.base')

@section('container')

<main class="container mx-auto pb-5 pt-10 px-16">
    <h2 class="text-2xl font-semibold mb-4">
        Produk
    </h2>


    <div class="flex justify-between">   
        <div class="mx-auto w-[280px] mr-7">
            <table class="border border-gray-300 w-full">
                <thead class="">
                    <tr class="">
                        <th id="refreshPage" class="bg-yellow-300 py-2 px-2 border-b flex h-12 cursor-pointer">
                            <svg class="w-10 h-full text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                            </svg>
                            <p class="font-medium ml-1 flex items-center pb-[2px]">
                                CARI TIPE PRODUK
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ( $types as $type )
                    <tr class="type-row cursor-pointer" data-type-id="{{ $type->id }}">
                        <td class="bg-white py-2 px-4 border-b break-all">
                            {{ $type->nama_type }}
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PRODUCT --}}
        <div id="product-container" class="w-full grid grid-cols-4 gap-3 text-sm mb-6">
            @foreach ($products as $product)
                 <a href="/product/{{ $product->id }}" class="product-card" data-type-id="{{ $product->type->id }}">
                    <div class="bg-white p-4 rounded-md shadow-md w-[213px] h-[400px] flex flex-col justify-between border-[1px]">
                        <div class="">
                            <div class="bg-gray-50 w-full flex justify-center border">
                                <img class="w-[150px] h-[200px] object-cover" src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                            </div>
                            <h3 class="font-semibold mt-2 mb-2 text-lg">{{ $product->nama_product }}</h3>
                            <div class="break-all uppercase rounded-2xl w-fit px-2 border-2">
                                <p class="font-semibold text-xs">
                                    {{ $product->type->nama_type }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-between gap-3">
                            <span class="text-blue-500 font-semibold">Rp. {{ number_format($product->harga) }}</span>
                            <div class="w-full flex justify-end">
                                <form action="{{ route('cart.add') }}" method='POST'>
                                    @csrf
                                    @method('post')
                                    <input type="hidden" value="{{ $product->id }}" name="id_product">
                                    <input type="hidden" value="1" name="kuantitas">
                                        <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95">
                                            BELI
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</main>

<x-footer />

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeRows = document.querySelectorAll('.type-row');
        const productContainer = document.getElementById('product-container');

        typeRows.forEach(typeRow => {
            typeRow.addEventListener('click', function () {
                const typeId = this.dataset.typeId;
                filterProducts(typeId);
            });
        });

        function filterProducts(typeId) {
            // Hide all products
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                product.style.display = 'none';
            });

            // Show products with the selected type
            const selectedProducts = document.querySelectorAll(`.product-card[data-type-id="${typeId}"]`);
            selectedProducts.forEach(product => {
                product.style.display = 'block';
            });
        }
    });






    document.addEventListener('DOMContentLoaded', function () {
        const refreshPageHeader = document.getElementById('refreshPage');

        refreshPageHeader.addEventListener('click', function () {
            location.reload(true);
        });
    });
</script>

@endsection