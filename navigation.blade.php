<nav x-data="{ open: false }" 
     @click.outside="open = false" 
     @keydown.escape.window="open = false"
     class="bg-[#275DAE] dark:bg-[#0E1A31] text-white border-b border-base-200 relative z-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-app.application-logo class="block h-9 w-auto fill-current" />
                    </a>
                </div>

                <div class="space-x-8 sm:-my-px ms-3 sm:ms-4 lg:ms-5 flex">
                    <x-navbar.system-title :href="route('home')" :active="request()->routeIs('home')" class="relative -top-0.75 text-[26px]">
                        {{ env('APP_NAME', '') }}
                    </x-navbar.system-title>
                </div>
            </div>

            <!-- Dropdown de opciones -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-navbar.theme-controller/>
                <x-navbar.dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="bg-[#275DAE] dark:bg-[#0E1A31] cursor-pointer inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-hidden">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">                
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-navbar.dropdown-link :href="route('logout')" class="bg-base-100 text-black dark:text-white focus:bg-base-300 flex items-center gap-2"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                                {{ __('Log Out') }}
                            </x-navbar.dropdown-link>
                        </form>
                    </x-slot>
                </x-navbar.dropdown>
            </div>

            <!-- Hamburguesa -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md hover:bg-black/20 focus:outline-hidden transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú para navegación móvil -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="hidden sm:hidden absolute top-full left-0 w-full bg-[#275DAE] dark:bg-[#0E1A31] border-b border-base-200 shadow-xl z-50"
         :class="{'block': open, 'hidden': ! open}">
        
        <div class="pt-4 pb-2 border-t border-white/10">
            <div class="pl-4.5 pr-2.5 flex items-center justify-between">
                <div>
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                </div>
                <div>
                    <x-navbar.theme-controller/>
                </div>
            </div>

            <div class="mt-4 space-y-1 px-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="flex items-center gap-2 w-full px-2 py-2 rounded-md text-white hover:bg-white/10 transition duration-150 ease-in-out"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>