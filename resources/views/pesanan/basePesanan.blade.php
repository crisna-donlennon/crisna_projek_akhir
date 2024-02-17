@extends('layouts.base')
@section('head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
@endsection

@section('container')
    @yield('content')
@endsection
