@extends('layouts.base')

@section('container')
  
<a href="/home">
    <button type="button" class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
</a>
<div class="bg-white container mx-auto my-8 p-8 rounded-md shadow-md w-2/3 flex flex-col border-[1px]">    
    <div class="h-[320px] w-full flex">
        <img class="w-[240px] h-[320px] object-cover" src="{{ asset('storage/'.$product[0]->gambar) }}" alt="Product Image">
        <!-- Product Information -->
        <div class="px-5 w-full">
            <div class="pb-2 border-b-2 w-fit">
                <h1 class="text-4xl font-bold">{{ $product[0]->nama_product }}</h1>
            </div>

            <div class="break-all uppercase rounded-2xl w-fit px-2 mt-2 border-2">
                <p class="font-semibold">
                    {{ $product[0]->type->nama_type }}
                </p>
            </div>

            <div class="flex my-5 w-full">
                <span class="bg-gray-100 text-2xl font-semibold text-yellow-500 p-3 w-full">Rp. {{ number_format($product[0]->harga) }}</span>
                <!-- Add to Cart button can be placed here -->
            </div>
        </div>
    </div>


    <div class="h-[320px] w-full flex flex-col justify-between mt-5">
        <div class="">
            <p class="font-semibold text-xl mb-2 border-t-2 pt-2">
                Deskripsi Produk: 
            </p>
            <p class="pb-2">
                {{ $product[0]->deskripsi }}
            </p>
        </div>
        <!-- Buttons and Stock Information -->
        <div class="flex justify-between w-full items-center py-1 border-t-2">
            <div class="py-1 pl-2">
                <p class="font-semibold">
                    Stok: 
                </p>
                <p class="font-semibold">
                    {{ $product[0]->stok }}
                </p>
            </div>

            <div class="mt-1">
                <form action="{{ route('cart.add') }}" method='POST'>
                    @csrf
                    @method('post')
                    <input type="hidden" value="{{ $product[0]->id }}" name="id_product">
                    <input type="hidden" value="1" name="kuantitas">
                    <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95">
                        BELI
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="py-5 border-y-2">
    <p class="">
        {{-- PRODUK DENGAN TYPE YANG SAMA --}}
    </p>
</div>



{{-- <div class="py-5 border-y-2">
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <div class="glide__slides">
                @foreach ($products as $productInSlider)
                    @if ($productInSlider->type->nama_type === $product[0]->type->nama_type && $productInSlider->id !== $product[0]->id)
                        <div class="glide__slide justify-center grid gap-3 text-sm">
                            <a href="/product/{{ $productInSlider->id }}" class="">
                                <div class="bg-white p-4 rounded-md shadow-md w-[230px] h-[400px] flex flex-col justify-between">
                                    <div class="">
                                        <div class="bg-gray-50 w-full flex justify-center border">
                                            <img class="w-[150px] h-[200px] object-cover" src="{{ asset('storage/' . $productInSlider->gambar) }}" alt="Product 1">
                                        </div>
                                        <h3 class="font-semibold mt-2 mb-2 text-lg">{{ $productInSlider->nama_product }}</h3>
                                        <div class="break-all uppercase rounded-2xl w-fit px-2 border-2">
                                            <p class="font-semibold text-xs">
                                                {{ $productInSlider->type->nama_type }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col justify-between gap-3">
                                        <span class="text-blue-500 font-semibold">Rp. {{ number_format($productInSlider->harga) }}</span>
                                        <div class="w-full flex justify-end">
                                            <form action="{{ route('cart.add') }}" method='POST'>
                                                @csrf
                                                @method('post')
                                                <input type="hidden" value="{{ $productInSlider->id }}" name="id_product">
                                                <input type="hidden" value="1" name="kuantitas">
                                                <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95">
                                                    BELI
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @elseif (count($products->where('type.nama_type', $product[0]->type->nama_type)) <= 1)
                        <div class="">                  

                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                </svg>
            </button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div> --}}



{{-- <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 5,
            autoplay: 8000, // Set to false if you don't want autoplay
        }).mount();
    });
</script> --}}

{{-- FOOTER --}}
<x-footer />

@endsection

