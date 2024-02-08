@extends('layouts.base')

@section('container')
{{-- CAROUSEL --}}
<div class="bg-red-500 w-full h-[500px]">
    <div class="glide w-full h-[500px]">
        <div class="glide__track w-full h-[500px]" data-glide-el="track">
            <ul class="glide__slides w-full h-[500px]">
                <li class="glide__slide"><img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpIydx0f-iLo-mn6I27wtO_22LrN35TJCJmQ&usqp=CAU" alt="Image 1"></li>
                <li class="glide__slide"><img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTd-ETt9QxodObUGkFPQDl9hIBFYSM8jyTj9w&usqp=CAU" alt="Image 2"></li>
                <li class="glide__slide"><img class="w-full h-full object-cover" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMIa956G5ODqyVmXUePBjgRZtxZZ9Fx_eyPw&usqp=CAU" alt="Image 3"></li>
                <!-- Add more slides as needed -->
            </ul>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Glide('.glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            autoplay: 3000, // Set to false if you don't want autoplay
        }).mount();
    });
</script>

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

{{-- MAIN PAGE --}}
<main class="container mx-auto pb-5 pt-10 px-16" id="product">
    <section class="mb-6">
        
        <h2 class="text-4xl font-semibold mb-7 border-b-4 pb-4 border-yellow-300 uppercase flex justify-center">
            PRODUK TERBARU
        </h2>

        <div class="w-full flex justify-center">
            <div class="grid grid-cols-5 gap-5 text-sm">
                @foreach ($products->take(10) as $product)
                    <a href="/product/{{ $product->id }}" class="">
                        <div class="bg-white p-4 rounded-md shadow-md w-[210px] h-[400px] flex flex-col justify-between border-[1px]">
                            <div class="">
                                <div class="bg-gray-50 w-full flex justify-center border">
                                    <img class="w-[150px] h-[200px] object-cover" src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                                </div>
                                <p class="font-semibold mt-2 mb-2 text-lg">{{ $product->nama_product }}</p>
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
                                            <button type="submit" class="bg-yellow-300 w-16 h-9 font-bold hover:brightness-95 uppercase">
                                                BELI
                                            </button>
                                            {{-- <div>
                                                <p>Stok: </p>
                                                <p>{{ $product->stok }}</p>
                                            </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-yellow-300 w-full py-1 mt-8 hover:brightness-95 justify-center flex">
            <a href="/productmain" class="items-center justify-center flex text-2xl font-bold">
                Temukan Lebih Banyak Produk ->
            </a>
        </div>
    </section>
</main>

<main class="bg-[#0A2974] container mx-auto min-w-full py-10 px-10 flex justify-end text-slate-100">
    <div class="w-[850px] text-right">  
        <p class="text-3xl font-bold text-yellow-300">
            Dengan banyak pilihan produk tersedia di katalog kami. Berbagai macam kebutuhan alat kebersihan dapat Anda temukan dengan mudah.
        </p>
        <div class="w-full flex justify-end mt-8">
            <button type="submit" class="font-bold hover:brightness-95 py-2 px-4 border-white border-2">
                LIHAT PRODUK
            </button>
        </div>
    </div> 
</main>

{{-- TUTORIAL --}}
<main class="container mx-auto min-w-full py-16 px-10 justify-center flex" id="tutorial">
    <div class="w-3/5">
        <div class="">
            <p class="text-3xl font-semibold mb-12">
                Langkah-langkah untuk pemesanan barang: 
            </p>
        </div>

        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    1. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H7a1 1 0 0 1-1-1v-7c0-.6.4-1 1-1Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">REGISTRASI/LOGIN</strong>
                    – Buat akun baru dengan mengisi data Anda pada form registrasi, atau lakukan login jika sudah mempunyai akun.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    2. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">CARI PRODUK</strong>
                    – Pilih barang sesuai kebutuhan yang Anda cari.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    3. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.8-3H7.4M11 7H6.3M17 4v6m-3-3h6"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">ADD TO CART</strong>
                    – Klik "BELI" untuk menambahkan barang ke keranjang belanja anda.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    4. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 1 12c0 .5-.5 1-1 1H6a1 1 0 0 1-1-1L6 8h12Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">CART</strong>
                    – Barang akan ditambahkan kedalam keranjang belanja/CART. Periksa kembali belanjaan Anda. Anda dapat menambah dan mengurangi jumlah barang atau menghapus barang pada CART.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    5. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M3 10h18M6 14h2m3 0h5M3 7v10c0 .6.4 1 1 1h16c.6 0 1-.4 1-1V7c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">CHECKOUT</strong>
                    – Klik "CHECKOUT" dari dalam CART Anda untuk lanjut ke proses pembayaran. Pilih pembayaran melalui rekening yang anda punya dengan saldo cukup.
                </p>
            </div>
        </div>
        <div class="flex justify-start mb-6 w-full">
            <div class="">
                <p class="font-bold text-xl">
                    6. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.4" d="m3.5 5.5 7.9 6c.4.3.8.3 1.2 0l7.9-6M4 19h16c.6 0 1-.4 1-1V6c0-.6-.4-1-1-1H4a1 1 0 0 0-1 1v12c0 .6.4 1 1 1Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">CHECK EMAIL</strong>
                    – Setelah order terkonfirmasi, Invoice akan dikirimkan ke email anda. Cek Email untuk lakukan pembayaran.
                </p>
            </div>
        </div>
        <div class="flex justify-start w-full">
            <div class="">
                <p class="font-bold text-xl">
                    7. 
                </p>
            </div>
            <div class="flex justify-center items-center p-5 ml-10 mr-16 border-[3px] rounded-xl border-[#0A2974]">
                <svg class="w-20 h-20 text-[#0A2974] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M15 4h3c.6 0 1 .4 1 1v15c0 .6-.4 1-1 1H6a1 1 0 0 1-1-1V5c0-.6.4-1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                </svg>
            </div>
            <div class="w-full flex">
                <p class="font-semibold h-fit w-fit">
                    <strong class="font-bold">SHIPPING CONFIRMATION</strong>
                    – Status pengiriman akan kita update melalui email.
                </p>
            </div>
        </div>
    </div>
</main>

    {{-- FOOTER --}}
    <x-footer />
@endsection
