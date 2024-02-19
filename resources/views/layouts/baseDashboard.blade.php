<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    @yield('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <style>
    /* Customize DataTable styles */
    #user-table_wrapper,
    #product-table_wrapper {
        /* padding: 20px; */
    }

    #user-table_filter input,
    #product-table_filter input {
        width: 200px;
        margin-bottom: 20px;
    }

    #user-table th,
    #user-table td,
    #product-table th,
    #product-table td {
        /* text-align: center; */
    }

    #user-table_paginate,
    #product-table_paginate {
        margin-top: 15px;
    }
    </style>
</head>

<body class="font-sans bg-slate-100">
    {{-- HEADER --}}
    <nav class="bg-[#0A2974] fixed top-0 z-50 w-full border-b shadow-lg dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">
                        Open sidebar
                    </span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                <div class="relative text-left w-full z-40 justify-start items-start flex">
                    <div class="bg-[#0A2974] ml-2">
                        <img src="{{ asset('storage/assets/FOTO/cleansweep-logo.png') }}" alt="Clean-sweep Logo" class="w-10">
                    </div>
                </div>
            
                <a href="/home">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-2 px-3 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
                </a>
            </div>
        </div>
    </nav>
    <div class="flex">
        @yield('container')
    </div>
</body>

</html>
