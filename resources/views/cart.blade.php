@extends('layouts.base')
@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection

@section('container')
    <a href="/home">
        <button type="button"
            class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
    </a>


    @php
        $productData = [];
        foreach ($cartItems as $item) {
            $productData[] = $item;
        }
    @endphp
    @if ($totalPrice !== 0)
        {{-- @foreach ($cartItems as $cartItem) --}}
        @foreach ($cartItems as $product)
            <div class="container flex mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
                <div class="flex w-full h-full">
                    <div class="flex w-1/2 font-bold align-middle items-center">
                        <p>{{ $product['nama_product'] }}</p>
                    </div>

                    <div class="flex w-1/2  font-bold align-middle justify-between items-center">
                        <p class="">|</p>
                        <p class="">{{ $product['pivot']['kuantitas'] }}</p>
                        <p class="">|</p>
                    </div>

                    <!-- You can also add buttons for updating quantity or removing the product -->
                    <div class="flex justify-end w-1/2 gap-1">
                        <div class="mr-3">
                            <p class="font-semibold">{{ 'Rp. ' . number_format($product['harga']) }}</p>
                        </div>
                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST" class="flex gap-1">
                            @csrf
                            <input type="hidden" value="increment" name="action">
                            <button
                                class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                type="submit" name="action" value="increment">
                                <svg class="flex w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3" d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('cart.update', ['id' => $product->id]) }}" method="POST" class="flex gap-1">
                            @csrf
                            <input type="hidden" value="decrement" name="action">
                            <button
                                class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                type="submit">
                                <svg class="flex w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3" d="M1 1h16" />
                                </svg>
                            </button>
                        </form>

                        <form action="{{ route('cart.delete', ['id' => $product->id]) }}" method="POST" class="">
                            @csrf
                            <button
                                class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                type="submit" name="action" value="delete">
                                <svg class="flex w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
        </div>
        {{-- @endforeach --}}

        <div class="container flex justify-between mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
            <div>
                <p class="font-semibold">Total harga: </p>
                <p class="font-bold">{{ 'Rp. ' . number_format($totalPrice) }}</p>
            </div>
            <div>
                <button type="button" id="checkoutButton"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Checkout</button>
            </div>
        </div>
    @else
        <div class="container flex mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
            <p>Keranjangmu kosong</p>
        </div>
    @endif
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
                        totalPrice: totalPrice,
                        id_cart: productData[0].pivot.id_cart,
                        payment_status: 1
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
@endsection
