@extends('layouts.base')

@section('container')


    {{-- MAIN PAGE --}}
    <main class="bg-slate-300 container mx-auto min-w-full pb-5 pt-10 px-10">
        <section class="bg-slate-300 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Produk</h2>
            <div class="bg-slate-400">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    @foreach ($products as $product)
                        <a href="/product/{{ $product->id }}"
                            class="transform hover:scale-105 transition-transform duration-300 ease-in-out">
                            <div class="bg-white p-4 rounded-md shadow-md max-h-96">
                                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1"
                                    class="w-full h-40 object-cover mb-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $product->nama_product }}</h3>
                                <p class="text-gray-600 overflow-hidden h-14">{{ $product->deskripsi }}</p>
                                <span class="text-blue-500 font-semibold">Rp. {{ number_format($product->harga) }}</span>
                                <form action="{{ route('cart.add') }}" method='POST'>
                                    @csrf
                                    @method('post')
                                    <input type="hidden" value="{{ $product->id }}" name="id_product">
                                    <input type="hidden" value="1" name="kuantitas">
                                    <div class="w-full flex justify-between items-center">
                                        <button type="submit" class="bg-red-600 mt-2 w-32 h-10 font-semibold">Add to Cart</button>
                                        <div>
                                            <p>Stok: </p>
                                            <p>{{ $product->stok }}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    {{-- KATEGORI --}}
    <main class="bg-slate-400 container mx-auto min-w-full pb-5 pt-10 px-10">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Kategori</h2>
            <div class="flex space-x-4">
                <!-- Category Cards go here -->
                <div class="bg-white p-4 rounded-md shadow-md flex items-center">
                    <img src="category1.jpg" alt="Category 1" class="w-16 h-16 object-cover rounded-full">
                    <span class="ml-4 text-lg font-semibold">Category 1</span>
                </div>
                <!-- Repeat similar structure for other categories -->
            </div>
        </section>
    </main>

    {{-- KOSONGAN --}}
    <main class="bg-red-400 container mx-auto min-w-full pb-5 pt-10 px-10">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Kategori</h2>
            <div class="flex space-x-4">
                <!-- Category Cards go here -->
                <div class="bg-white p-4 rounded-md shadow-md flex items-center">
                    <img src="category1.jpg" alt="Category 1" class="w-16 h-16 object-cover rounded-full">
                    <span class="ml-4 text-lg font-semibold">Category 1</span>
                </div>
                <!-- Repeat similar structure for other categories -->
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <x-footer />
@endsection
