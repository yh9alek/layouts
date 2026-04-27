@props(['codigo' => '', 'titulo' => '', 'descripcion' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-screen bg-[#0F0F0F] bg-no-repeat bg-fixed">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/assets/css/app.css', 'resources/assets/js/app.js'])
        @vite(['resources/assets/js/jstree.min.js', 'resources/assets/css/style.min.css'])
    </head>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Google Sans'
        }
    </style>

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-25 sm:pt-0">
            <div class="mx-auto px-5 w-full max-w-150 min-[691px]:px-0 max-[691px]:pt-7.5">
                <div class="mb-12.5 flex items-end justify-start gap-10">
                    <img class="block" src="{{ asset(in_array($codigo, ['500', '503']) ? '/tmaz-logo-error-500.png' : '/tmaz-logo-error.png') }}">
                    <h1 class="text-[#616d7994] text-6xl codigo" @style(['color:#BB5E61' => in_array($codigo, ['500', '503'])])>{{ $codigo }}</h1>
                </div>

                <p class="font-['Segoe_UI'] text-[24px] mb-3 md:mb-0 font-medium text-[#9AA0A6]">
                    {{ $titulo }}
                </p>
                
                <div class="mb-12.5">
                    <p class="font-['Segoe_UI'] text-sm md:text-[15px] text-[#9AA0A6]">
                        @if(in_array($codigo, ['500', '503']))
                            <div class="w-4.5 h-4.5 inline-flex mr-1 items-center justify-center bg-rose-500 rounded-md">
                                <svg width="2" height="10" class="text-white" viewBox="0 0 2 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.00006 6.3188C1.41416 6.3188 1.75006 5.98295 1.75006 5.56885V1.43115C1.75006 1.01705 1.41416 0.681152 1.00006 0.681152C0.585961 0.681152 0.250061 1.01705 0.250061 1.43115V5.56885C0.250061 5.98295 0.585961 6.3188 1.00006 6.3188Z" fill="currentColor"></path>
                                    <path d="M1.00006 9.41699C1.55235 9.41699 2.00007 8.96929 2.00007 8.41699C2.00007 7.86469 1.55235 7.41699 1.00006 7.41699C0.447781 7.41699 6.10352e-05 7.86469 6.10352e-05 8.41699C6.10352e-05 8.96929 0.447781 9.41699 1.00006 9.41699Z" fill="currentColor "></path>
                                </svg>
                            </div>
                        @endif
                        {{ $descripcion }}
                    </p>
                </div>
                
                <div class="flex items-center justify-start">
                    <a href="#" 
                    id="btnRegresar"
                    onclick="window.history.back();" 
                    class="m-0 cursor-pointer select-none rounded-[20px] border-0 bg-[#8AB4F8] px-4 py-[6px] text-center font-sans text-[13.125px] text-[#202124] no-underline transition-shadow duration-150 ease-in-out max-[420px]:fixed max-[420px]:bottom-5 max-[420px]:left-5 max-[420px]:w-[90%] max-[420px]:px-6 max-[420px]:py-3">
                        @if(in_array($codigo, ['401', '419']))
                            Iniciar Sesión
                        @else
                            Regresar
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
