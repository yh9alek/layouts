<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-white bg-no-repeat! bg-fixed! bg-center" style="background-image: url('{{ asset('/terminal1_1920.jpg') }}');">
    
    @include('layouts.refs.head')

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-25 sm:pt-0">
            <div class="w-full max-w-85 -mt-22 p-6 bg-white shadow-md overflow-hidden rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
