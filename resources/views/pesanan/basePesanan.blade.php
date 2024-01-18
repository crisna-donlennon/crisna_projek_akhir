@extends('layouts.base')
@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection

@section('container')
    <div
        class="bg-slate-300 text-white pt-2 pb-2 w-full z-50 border-b-2 border-gray-400 flex justify-start items-center space-x-4">
        <a href="/order/pesanan-pending" class="text-black hover:text-gray-500 transition duration-300 ease-in-out border-r-4 px-2">PESANAN PENDING</a>
        <a href="/order/pesanan-paid" class="text-black hover:text-gray-500 transition duration-300 ease-in-out border-r-4 px-2">PESANAN PAID</a>
    </div>
    @yield('content')
@endsection
