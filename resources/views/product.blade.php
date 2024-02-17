@extends('layouts.base')

@section('container')
  
<a href="/home">
    <button type="button" class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
        Kembali
    </button>
</a>

<div class="bg-white container mx-auto my-8 p-8 rounded-md shadow-md w-2/3 flex flex-col border-[1px]">    
    <div class="h-[320px] w-full flex">
        <img class="w-[240px] h-[320px] object-cover" src="{{ asset('storage/'.$product[0]->gambar) }}" alt="Product Image">
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
                <span class="bg-gray-100 text-2xl font-semibold text-yellow-500 p-3 w-full">
                    Rp. {{ number_format($product[0]->harga) }}
                </span>
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
        <div class="flex w-full items-center border-t-2 pt-4 pr-2">
            <div class="flex w-full justify-start items-center">    
                <div class="w-20">
                    <p class="font-semibold text-sm  flex justify-center text-gray-700 uppercase">
                        Stok
                    </p>
                    <p class="flex justify-center text-gray-500">
                        {{ $product[0]->stok }}
                    </p>
                </div>
                <div class="w-20">
                    <p class="text-sm font-semibold flex justify-center text-gray-700 uppercase">
                        Berat
                    </p>
                    <p class="flex justify-center text-gray-500">
                        {{ $product[0]->berat }} gram
                    </p>
                </div>
            </div>

            <div class="flex w-full justify-end items-center">
                <div class="">
                    <form action="{{ route('cart.add') }}" method='POST'>
                        @csrf
                        @method('post')
                        <input type="hidden" value="{{ $product[0]->id }}" name="id_product">
                        <input type="hidden" value="1" name="kuantitas">
                        <button type="submit" class="bg-yellow-300 w-40 h-9 font-bold hover:brightness-95 rounded-md">
                            BELI
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

