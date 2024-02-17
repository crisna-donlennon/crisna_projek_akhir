@extends('layouts.baseDashboard')

@section('container')
    <div class="flex w-full justify-between">
        {{-- SIDEBAR --}}
        <aside id="logo-sidebar" class="bg-slate-200 w-56 h-full shadow-lg shadow-gray-500 min-h-screen pt-20 transition-transform -translate-x-full border-r-2 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="bg-slate-200 h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    {{-- USER PANEL --}}
                    <li>
                        <a href="/dashboard" class="{{ url()->current() == url('/dashboard') ? 'flex border-l-4 border-[#0A2974] pl-3 bg-slate-100 opacity-90 rounded-r-md' : '' }}">
                            <div class="flex items-center p-1 text-gray-900 rounded-lg dark:text-white hover:bg-slate-100 dark:hover:bg-gray-700 group h-10 transition-all duration-300 active:scale-95">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.3-2a6 6 0 0 0 0-6A4 4 0 0 1 20 8a4 4 0 0 1-6.7 3Zm2.2 9a4 4 0 0 0 .5-2v-1a6 6 0 0 0-1.5-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.5Z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ms-3">
                                    User
                                </span>
                            </div>    
                        </a>
                    </li>
                    {{-- PRODUCT PANEL --}}
                    <li>
                        <a href="/dashboard/product" class="{{ url()->current() == url('/dashboard/product') ? 'flex border-l-4 border-[#0A2974] pl-3 bg-slate-100 opacity-90 rounded-r-md' : '' }}">
                            <div class="flex items-center p-1 text-gray-900 rounded-lg dark:text-white hover:bg-slate-100 dark:hover:bg-gray-700 group h-10 transition-all duration-300 active:scale-95">  
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M20 10H4v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8ZM9 13v-1h6v1c0 .6-.4 1-1 1h-4a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                                    <path d="M2 6c0-1.1.9-2 2-2h16a2 2 0 1 1 0 4H4a2 2 0 0 1-2-2Z"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap pb-[1px]">
                                    Produk
                                </span>
                            </div>
                        </a>
                    </li>
                    {{-- TYPE PANEL --}}
                    <li>
                        <a href="/dashboard/type" class="{{ url()->current() == url('/dashboard/type') ? 'flex border-l-4 border-[#0A2974] pl-3 bg-slate-100 opacity-90 rounded-r-md' : '' }}">
                            <div class="flex items-center p-1 text-gray-900 rounded-lg dark:text-white hover:bg-slate-100 dark:hover:bg-gray-700 group h-10 transition-all duration-300 active:scale-95">     
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M5 8h0m0 4h0m0 4h0"/>
                                </svg>                        
                                <span class="flex-1 ms-3 whitespace-nowrap pb-[2px]">
                                    Type
                                </span>
                            </div>
                        </a>
                    </li>
                    {{-- INVOICE PANEL --}}
                    <li>
                        <a href="/dashboard/invoice" class="{{ url()->current() == url('/dashboard/invoice') ? 'flex border-l-4 border-[#0A2974] pl-3 bg-slate-100 opacity-90 rounded-r-md' : '' }}">                        
                            <div class="flex items-center p-1 text-gray-900 rounded-lg dark:text-white hover:bg-slate-100 dark:hover:bg-gray-700 group h-10 transition-all duration-300 active:scale-95">     
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5.6 2c.4 0 .8 0 1.1.3L8 3.6l1.3-1.3a1 1 0 0 1 1.4 0L12 3.6l1.3-1.3a1 1 0 0 1 1.4 0L16 3.6l1.3-1.3A1 1 0 0 1 19 3v18a1 1 0 0 1-1.7.7L16 20.4l-1.3 1.3a1 1 0 0 1-1.4 0L12 20.4l-1.3 1.3a1 1 0 0 1-1.4 0L8 20.4l-1.3 1.3A1 1 0 0 1 5 21V3c0-.4.2-.8.6-1ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap pb-[2px]">
                                    Invoice
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>


        
        {{-- MAIN --}}
        <div class="bg-slate-100 w-full">
            <div class="rounded-lg mt-14 px-8 py-7">
                <div class="flex text-black w-full z-40 rounded-lg shadow-sm border-[1px]">
                    <div class="text-black bg-white rounded-lg p-4 w-full overflow-auto border-[1px]">
                        @yield('header')
                    </div>
                </div>
            </div>
            <div class="rounded-lg px-8 mb-8">
                <div class="flex text-black w-full z-40 rounded-lg shadow-md border-[1px]">
                    <div class="text-black bg-white rounded-lg p-5 w-full overflow-auto border-[1px]">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
