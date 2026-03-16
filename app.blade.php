<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.refs.head')

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-base-100">

            <!-- Barra de navegación superior -->
            @include('layouts.navigation')

            <!-- Cabecera de página -->
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Contenido de página -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

</html>
