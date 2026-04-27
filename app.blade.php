<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.refs.head')

    <body class="antialiased bg-base-100 text-base-content relative">

        <!-- 1. NAVBAR -->
        <header class="fixed top-0 w-full z-50 h-16 bg-base-100 border-b border-base-200">
            @include('layouts.navigation')
        </header>

        <!-- 2. CONTENEDOR PRINCIPAL -->
        <div class="drawer lg:drawer-open flex-1 pt-10">
            <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
            
            <!-- 3. SIDEBAR -->
            @include('layouts.sidebar')
            
            <!-- CONTENIDO CENTRAL -->
            <div class="drawer-content flex flex-col">
                <main class="flex-1 p-4 w-full overflow-hidden">
                    <div class="max-w-350 w-full h-[calc(100vh-96px)] no-scrollbar overflow-y-scroll mx-auto py-4 px-1 sm:px-2.5 lg:px-8">
                        {{ $slot }}
                        <div class="mb-12"></div>
                    </div>
                </main>
            </div>

        </div>

        <script>
            document.fonts.ready.then(() => {
                document.documentElement.classList.add('fonts-loaded');
            });
        </script>
        @stack('scripts')
    </body>

</html>
