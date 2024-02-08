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
            /* width: 200px;  */
            /* margin-bottom: 10px;  */
        }
    
        #user-table th,
        #user-table td,
        #product-table th,
        #product-table td {
            /* text-align: center;  */
        }
    
        #user-table_paginate,
        #product-table_paginate {
            /* margin-top: 10px;  */
        }
    </style>
    
</head>

<body class="font-sans bg-slate-300">
    @yield('container')
</body>

</html>
