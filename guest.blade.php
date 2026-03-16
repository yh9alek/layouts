<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    @include('layouts.refs.head')

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-25 sm:pt-0 bg-base-100">
            <div>
                <a href="/">
                    <x-app.application-logo class="w-20 h-20 fill-current" />
                </a>
            </div>

            <div class="w-full max-w-85 mt-6 p-6 bg-base-100 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
