<nav class="navbar w-full flex justify-between color-base text-white border-b border-base-200 px-4 sm:px-6">
    <div class="flex gap-2">
        <div class="flex">

            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-app.application-logo class="block h-9 w-auto fill-current" />
                </a>
            </div>

            <div class="space-x-8 sm:-my-px ms-3 sm:ms-4 lg:ms-5 flex">
                <x-navbar.system-title :href="route('home')" :active="request()->routeIs('home')" class="relative -top-0.75 text-[26px] font-bold">
                    {{ env('APP_NAME', '') }}
                </x-navbar.system-title>
            </div>
        </div>
        <label for="sidebar-drawer" class="btn btn-circle btn-ghost active:bg-transparent hover:bg-transparent text-white lg:hidden">
            <span class="material-symbols-rounded text-2xl">menu</span>
        </label>
    </div>

    <div class="flex gap-2 items-center">
        
        <x-navbar.theme-controller/>

        {{-- <!-- AYUDA -->
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle" title="Ayuda">
                <span class="material-symbols-rounded">help</span>
            </div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow-lg border border-base-200 mt-3">
                <li>
                    <a href="/pages/general/profile" class="flex items-center gap-2 py-3">
                        <span class="material-symbols-rounded text-lg">download</span>
                        Descargar Ayuda
                    </a>
                </li>
            </ul>
        </div> --}}

        <!-- ÍCONO DE PERFIL -->
        <div class="dropdown dropdown-end ml-1">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar placeholder">
                <div class="bg-[#4177A8] dark:bg-[#16315D] text-white grid place-items-center rounded-full w-10">
                    <span class="text-sm font-semibold">{{ $iniciales }}</span>
                </div>
            </div>
            <div tabindex="0" class="dropdown-content bg-base-100 rounded-box z-1 w-72 shadow-lg border border-base-200 mt-3 p-0 overflow-hidden">
                <div class="flex flex-col items-center border-b border-base-300 dark:border-base-200 py-6 bg-base-200/50">
                    <div class="avatar placeholder mb-3">
                        <div class="bg-[#4177A8] dark:bg-[#16315D] text-white grid place-items-center rounded-full w-16">
                            <span class="text-xl font-bold">{{ $iniciales }}</span>
                        </div>
                    </div>
                    <p class="font-bold text-base-content text-center px-4">{{ $nombre }}</p>
                    <p class="text-sm text-base-content/70">{{ $email }}</p>
                </div>
                <ul class="menu p-2 w-full">
                    <li>
                        <a href="#" class="py-3 flex gap-2 w-full text-base-content/70 hover:bg-base-200">
                            <span class="material-symbols-rounded">person</span>
                            <span class="relative top-px">Perfil</span>
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button href="/logout" class="p-3 flex gap-2 w-full text-error cursor-pointer hover:bg-base-200 rounded-md">
                            <span class="material-symbols-rounded">logout</span>
                            <span class="relative top-px">Cerrar Sesión</span>
                        </button>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>