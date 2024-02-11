<div class="bg-slate-200 text-black pt-14 pb-5 w-full z-50 border-b-2 border-gray-400 flex justify-end items-center pr-10 leading-5 h-28 gap-10">
    @auth
        <a href="/cart" class=" hover:text-[#0A2974] transition duration-300 ease-in-out">
            CART
        </a>
        <a href="/order/pesanan-pending" class=" hover:text-[#0A2974] transition duration-300 ease-in-out">
            PESANANAN
        </a>
    

        <div class="">
            <div class="relative inline-block text-left z-50">
                <div class=" relative inline-block text-left dropdown">
                    <span class="">
                    <button class="inline-flex justify-center transition duration-150 ease-in-out hover:text-[#0A2974]" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                        <span>
                            PROFILE
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
