@extends('layouts.base')

@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection

@section('container')
    <main class="container mx-auto pb-5 pt-10 px-16" id="product">

        <h2 class="text-4xl font-semibold border-b-4 pb-8 border-[#0A2974] uppercase flex justify-center">
            CART
        </h2>

        @php
            $productData = [];
            foreach ($cartItems as $item) {
                $productData[] = $item;
            }
        @endphp

        <div class="flex justify-center gap-7">
            @if ($totalPrice !== 0)
                <div class="w-3/5">
                    @foreach ($cartItems as $product)
                        <div class="container flex my-5 p-5 bg-white rounded-md shadow-md border-[1px]">
                            <div class="flex w-full h-full">
                                <div class="flex justify-center mr-5">
                                    <img class="w-[60px] h-[80px] object-cover"
                                        src="{{ asset('storage/' . $product->gambar) }}" alt="Product 1">
                                </div>
                                <div class="flex font-medium pt-1">
                                    <p>{{ $product['nama_product'] }}</p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between w-full mb-2 px-1">
                                    <p class="">
                                        Rp.
                                    </p>
                                    <p class="">
                                        {{ number_format($product['harga'] * $product['pivot']['kuantitas']) }}
                                    </p>
                                </div>

                                <div class="flex-col justify-between">
                                    <div class="flex justify-between border-[1px] ">
                                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST"
                                            class="flex">
                                            @csrf
                                            <input type="hidden" value="decrement" name="action">
                                            <button
                                                class="flex text-center items-center justify-center w-8 h-w-8 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                                type="submit">
                                                <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                                </svg>
                                            </button>
                                        </form>

                                        <div class="flex items-center justify-center border-x-[1px] px-4">
                                            <p class="">{{ $product['pivot']['kuantitas'] }}x</p>
                                        </div>

                                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST"
                                            class="flex">
                                            @csrf
                                            <input type="hidden" value="increment" name="action">
                                            <button
                                                class="flex text-center items-center justify-center w-8 h-w-8 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                                type="submit" name="action" value="increment">
                                                <svg class="w-4 h-4 text-black" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <form action="{{ route('cart.delete', ['id' => $product->id]) }}" method="POST"
                                        class="">
                                        @csrf
                                        <button
                                            class="hover:text-red-500 flex border-x-[1px] border-b-[1px] text-center items-center justify-center w-full"
                                            type="submit" name="action" value="delete">
                                            <p class="text-xs py-1">
                                                HAPUS
                                            </p>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="max-w-[331px]">
                    <div class="rounded-md flex-col h-fit flex my-5 px-5 py-4 bg-white text-sm border-[1px]">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline pb-5">
                                Pilih Alamat
                            </p>
                        </div>

                        <select name="selected_address" id="selected_address">
                            @foreach ($alamats as $alamat)
                                <option value="{{ $alamat->id }}">{{ $alamat->alamat_detail . ', ' . $alamat->nama_city . ', ' . $alamat->nama_province }}</option>
                            @endforeach
                            <option value="new">Tambah Alamat Baru</option>
                        </select>
                    
                        <div id="selected_address_display">
                            <!-- Default display, you might initially display the first address -->
                            <div class="break-words border-black border p-3">
                                <p>Alamat : {{ $alamats[0]->alamat_detail . ', ' . $alamats[0]->nama_city . ', ' . $alamats[0]->nama_province }}</p>
                            </div>
                        </div>


                        <div class="flex justify-between border-y-[1px] pb-[2px] mt-1">
                            <div class="flex w-full h-full">
                                <div class="flex font-medium break">
                                    <p class="flex items-center">
                                        Ongkir:
                                    </p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between pl-4">
                                    <p class="">
                                        Rp.
                                    </p>
                                    <p class="">
                                        2,000
                                    </p>
                                </div>
                            </div>
                        </div>


                        <a href="/create-alamat"
                            class="bg-yellow-300 mt-12 w-full flex items-center justify-center h-9 font-bold hover:brightness-95 uppercase ">
                            TAMBAH ALAMAT
                        </a>
                    </div>
                    <div class="rounded-md flex-col h-fit flex my-5 px-5 py-4 bg-white text-sm border-[1px]">
                        <div class="">
                            <p class="font-semibold text-lg uppercase flex justify-center underline pb-5">
                                CHECKOUT
                            </p>
                        </div>



                        @foreach ($cartItems as $product)
                            <div class="container flex">
                                <div class="flex w-full h-full">
                                    <div class="flex font-medium break">
                                        <p class="flex items-center">
                                            {{ $product['nama_product'] }}
                                        </p>
                                    </div>
                                </div>

                                <div class="w-48">
                                    <!-- You can also add buttons for updating quantity or removing the product -->
                                    <div class="flex justify-between pl-4">
                                        <p class="flex items-center">
                                            Rp.
                                        </p>
                                        <p class="flex items-center">
                                            {{ number_format($product['harga'] * $product['pivot']['kuantitas']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="flex justify-between border-y-[1px] pb-[2px] mt-1">
                            <div class="flex w-full h-full">
                                <div class="flex font-medium break">
                                    <p class="flex items-center">
                                        Ongkir:
                                    </p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between pl-4">
                                    <p class="">
                                        Rp.
                                    </p>
                                    <p class="">
                                        2,000
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div class="flex w-full h-full">
                                <div class="flex font-medium break">
                                    <p class="font-bold uppercase flex items-center">
                                        TOTAL HARGA:
                                    </p>
                                </div>
                            </div>

                            <div class="w-48">
                                <!-- You can also add buttons for updating quantity or removing the product -->
                                <div class="flex justify-between pl-4 font-bold">
                                    <p class="flex items-center">
                                        Rp.
                                    </p>
                                    <p class="flex items-center">
                                        {{ number_format($totalPrice + 2000) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button class="bg-yellow-300 mt-12 w-full h-9 font-bold hover:brightness-95 uppercase"
                            type="button" id="checkoutButton">
                            CHECKOUT
                        </button>
                    </div>
                </div>
            @else
                <div
                    class="container flex mx-auto my-8 p-5 pl-8 bg-white rounded-md shadow-md w-11/12 flex-col justify-between">
                    <p class="text-gray-500 text-lg">
                        Keranjang Anda kosong.
                    </p>
                </div>
            @endif
        </div>

        <script>
            $("#checkoutButton").click(function(event) {
                event.preventDefault();

                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

                const productData = ({!! json_encode($productData) !!});
                const totalPrice = {!! json_encode($totalPrice) !!}
                fetch('order/pay-and-create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            productData: productData,
                            totalPrice: totalPrice + 2000,
                            id_cart: productData[0].pivot.id_cart,
                            payment_status: 'pending'
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        snap.pay(data.snap_token.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '/order/pesanan-paid'
                            },
                            onPending: function(result) {
                                window.location.href = '/order/pesanan-pending'
                            },
                            onClose: function(result) {
                                window.location.href = '/order/pesanan-pending'
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error during fetch:', error);
                    });
            })
        </script>
    </main>
@endsection
