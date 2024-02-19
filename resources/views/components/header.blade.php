<div class="bg-slate-200 text-black pt-14 pb-5 w-full z-40 border-b-2 border-gray-400 flex justify-end items-center leading-5 gap-7
            xl:h-28 lg:h-28 md:h-28 sm:h-24 min-[320px] max-[640px]:h-24
            xl:pr-10 lg:pr-8 md:pr-7 sm:pr-5 min-[320px] max-[640px]:pr-5">
    <div class="relative text-left w-full z-40 justify-start items-start flex">
        <div class="bg-[#0A2974] p-2 ml-3">
            <img src="{{ asset('storage/assets/FOTO/cleansweep-logo.png') }}" alt="Clean-sweep Logo" class="w-14">
        </div>
    </div>
    @auth
        <a href="/cart" class="pr-5 border-r-2 border-black">
            <div class="relative w-fit pr-1 pt-1 h-fit">
                <svg class="w-9 h-9 relative hover:text-[#0A2974] active:scale-95 transition duration-300 ease-in-out text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.3L19 7H7.3"/>
                </svg>
                @if ($cartItemCount > 0)
                    <span class="bg-red-600 top-0 right-0 flex items-center justify-center text-sm text-white rounded-full h-5 w-5 absolute">
                        {{ $cartItemCount }}
                    </span>
                @endif
            </div>
        </a>

        <div class="">
            <div class="relative inline-block text-left z-40">
                <div class="relative inline-block text-left dropdown">
                    <span class="">
                        <button class="inline-flex justify-center transition duration-300 ease-in-out hover:text-[#0A2974] uppercase" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                            <span>
                                PESANAN
                            </span>
                        </button>
                    </span>
                    <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none text-sm font-normal" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <div class="">
                                <div class="">
                                    <a class="block text-sm py-3 px-4 text-gray-700 hover:bg-gray-100" role="menuitem" href="/order/pesanan-pending">
                                        Pesanan Pending
                                    </a>
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    <a class="block text-sm py-3 px-4 text-gray-700 hover:bg-gray-100" role="menuitem" href="/order/pesanan-paid">
                                        Pesanan Lunas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>              
        </div>



        <div class="">
            <div class="relative inline-block text-left z-40">
                <div class="relative inline-block text-left dropdown">
                    <span class="">
                        <button class="inline-flex justify-center transition duration-300 ease-in-out hover:text-[#0A2974]" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                            <span>
                                PROFIL
                            </span>
                        </button>
                    </span>

                    <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none text-sm pt-2 font-normal" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                        <div class="px-4 py-1 right-0">         
                            <p class="text-sm leading-5">
                                Akun:
                            </p>
                            <p class="text-sm font-medium leading-5 text-gray-900 truncate">
                                {{ Auth::user()->name }}
                            </p>
                        </div>
                        <div class="py-1">
                            @if (Auth::user()->roles == 'admin' || Auth::user()->roles == 'pemilik')
                            <div class="">
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" href="/dashboard">
                                        Dashboard
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="py-1">
                            <!-- New Account menu item -->
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" href="/account">
                                Account
                            </a>
                        </div>                
                        <div class="py-1 border-t-[1px]">
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" href="/logout">
                                Logout
                            </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>              
        </div>
            
        <style>
        .dropdown:focus-within .dropdown-menu {
            opacity:1;
            transform: translate(0) scale(1);
            visibility: visible;
        }
        </style>

        
    @else
        <a href="/login" class=" hover:text-[#0A2974] transition duration-300 ease-in-out">LOGIN</a>
        <a href="/registration" class=" hover:text-[#0A2974] transition duration-300 ease-in-out">REGISTER</a>
    @endauth
</div>
