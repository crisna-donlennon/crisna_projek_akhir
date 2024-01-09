@extends('layouts.base')

@section('container')
  
<a href="/home">
    <button type="button" class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
</a>

@foreach ($cartItems as $item)
    <div class="container flex mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
        <div class="flex w-full h-full">
            <div class="flex w-1/2 font-bold align-middle items-center">
                <p>{{ $item->product->nama_product }}</p>
            </div>

            <div class="flex w-1/2  font-bold align-middle justify-between items-center">
                <p class="">|</p>
                <p class="">{{ $item->jumlah }}</p>
                <p class="">|</p>
            </div>

            <!-- You can also add buttons for updating quantity or removing the product -->
            <div class="flex justify-end w-1/2 gap-1">
                <form action="{{ route('cart.update', ['id' => $item->id]) }}" method="POST" class="flex gap-1" >
                    @csrf
                    <button class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125" type="submit" name="action" value="increase">
                        <svg class="flex w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                    <button class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"  type="submit" name="action" value="decrease">
                        <svg class="flex w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M1 1h16"/>
                        </svg>
                    </button>
                </form>
                
                <form action="{{ route('cart.delete', ['id' => $item->id]) }}" method="POST" class="" >
                    @csrf
                    <button class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"  type="submit" name="action" value="delete">
                        <svg class="flex w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- <form action="{{ route('cart.remove') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->product->id }}">
            <button type="submit">Remove from Cart</button>
        </form> --}}
    </div>
@endforeach

@endsection