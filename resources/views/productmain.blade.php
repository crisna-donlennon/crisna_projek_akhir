@extends('layouts.base')

@section('container')
    <main class="container mx-auto pb-5 pt-10 px-16">
        <h2 class="text-4xl font-semibold mb-5 border-b-4 pb-4 border-yellow-300 uppercase flex justify-center">
            KATALOG PRODUK
        </h2>

        <div class="mb-4 shadow-sm border-[1px] border-gray-300 rounded-md">
            <input type="text" id="productSearch" class="border rounded p-2 w-full" placeholder="Cari berdasarkan nama produk...">
        </div>

        <div class="
        xl:flex lg: md: sm: min-[320px] max-[640px]:
        xl:justify-between lg: md: sm: min-[320px] max-[640px]:">
      
            {{-- TYPE --}}
            <div class="mx-auto mr-7 mb-10
            xl:w-[280px] lg: md: sm: min-[320px] max-[640px]:w-full">
                <table class="border border-gray-300 w-full">
                    <thead class="">
                        <tr class="">
                            <th id="refreshPage"
                                class="bg-yellow-300 py-2 px-2 border-b flex h-12 cursor-pointer hover:brightness-95 active:scale-95 transition duration-300 ease-in-out">
                                <svg class="w-10 h-full text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M5 7h14M5 12h14M5 17h14" />
                                </svg>
                                <p class="font-medium ml-1 flex items-center pb-[2px]">
                                    CARI TIPE PRODUK
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($types as $type)
                            <tr class="type-row cursor-pointer hover:brightness-95 active:scale-95 transition duration-300 ease-in-out"
                                data-type-id="{{ $type->id }}">
                                <td class="bg-white py-2 px-4 border-b break-all">
                                    {{ $type->nama_type }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



            {{-- PRODUCT --}}
            <div id="product-container"
                class="grid gap-3 text-sm mb-6 overflow-y-scroll overflow-hidden pb-3 h-[840px] w-full
                xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 min-[320px] max-[640px]:grid-cols-2
                xl: lg: md: sm: min-[320px] max-[640px]:">

                @foreach ($products as $product)
                    <div data-type-id="{{ $product->type->id }}" class="product-card bg-white p-4 rounded-md relative shadow-md flex flex-col justify-between border-[1px]
                        xl:w-[213px] lg: md: sm: min-[320px] max-[640px]:
                        xl:h-[400px] lg: md: sm: min-[320px] max-[640px]:">
                        <a href="/product/{{ $product->id }}" class="" >
                            <div class="">
                                <div class="bg-gray-50 w-full flex justify-center border">
                                    <img class="w-[150px] h-[200px] object-cover" src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                                </div>
                                <p class="font-semibold mt-2 mb-2 text-lg line-clamp-1">
                                    {{ $product->nama_product }}
                                </p>
                                <div class="break-all uppercase rounded-2xl w-fit px-2 border-2">
                                    <p class="font-semibold text-xs">
                                        {{ $product->type->nama_type }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col justify-end h-[100px]">
                                <span class="text-blue-500 font-semibold w-full">
                                    Rp. {{ number_format($product->harga) }}
                                </span>
                                <div class="w-full flex justify-end">
                                    <form action="{{ route('cart.add') }}" method='POST'>
                                        @csrf
                                        @method('post')
                                        <input type="hidden" value="{{ $product->id }}" name="id_product">
                                        <input type="hidden" value="1" name="kuantitas">
                                        <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95 rounded-md">
                                            BELI
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                        @if ($product->stok <= 0)
                            <div class="bg-[#00000060] cursor-not-allowed absolute w-[213px] h-[400px] top-0 left-0 rounded-md flex justify-center align-middle items-center uppercase text-gray-200 text-lg">
                                STOK HABIS
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        </div>
        {{-- <div class="">
        <!-- Pagination links -->
        {{ $products->links() }}
    </div> --}}

    </main>

    {{-- <x-footer /> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeRows = document.querySelectorAll('.type-row');
            const productContainer = document.getElementById('product-container');

            typeRows.forEach(typeRow => {
                typeRow.addEventListener('click', function() {
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






        document.addEventListener('DOMContentLoaded', function() {
            const refreshPageHeader = document.getElementById('refreshPage');

            refreshPageHeader.addEventListener('click', function() {
                location.reload(true);
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            // ... Your existing code ...

            // Add event listener for search input
            const productSearchInput = document.getElementById('productSearch');
            productSearchInput.addEventListener('input', function() {
                const searchTerm = this.value.trim().toLowerCase();
                filterProductsByName(searchTerm);
            });

            function filterProductsByName(searchTerm) {
                // Hide all products
                const products = document.querySelectorAll('.product-card');
                products.forEach(product => {
                    const productName = product.querySelector('.font-semibold').textContent.toLowerCase();
                    if (productName.includes(searchTerm)) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
