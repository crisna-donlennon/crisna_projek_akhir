@extends('layouts.base')

@section('container')
    
{{-- NAVBAR --}}
<x-navbar/>

{{-- HEADER --}}
<x-header/>
    {{-- MAIN PAGE --}}
    <main class="bg-slate-300 container mx-auto min-w-full pb-5 pt-10 px-10">
        <section class="bg-slate-300 mb-8">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <p>Forbidden</p>
        </section>
    </main>

        {{-- FOOTER --}}
    <x-footer/>
@endsection