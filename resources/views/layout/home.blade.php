<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0F0F0E] text-[#EDEDEC] min-h-screen antialiased flex flex-col">

    {{-- Header --}}
    <header class="border-b border-[#3E3E3A] bg-[#161615]">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight">
                ORGANIZADOR DE EVENTOS
            </a>

            {{-- Navegação --}}
            @if (Route::has('login'))
                <nav class="flex items-center gap-3 text-sm">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-4 py-2 rounded-md border border-[#3E3E3A]
                                   hover:border-[#62605b] hover:bg-black transition">
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2 rounded-md text-[#A1A09A]
                                   hover:text-[#EDEDEC] transition">
                            Login
                        </a>

                        @if (Route::has('register.index'))
                            <a
                                href="{{ route('register.index') }}"
                                class="px-4 py-2 rounded-md border border-[#3E3E3A]
                                       hover:border-[#62605b] hover:bg-black transition">
                                Registrar
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

        </div>
    </header>

    {{-- Conteúdo --}}
    <main class="flex-1 max-w-6xl mx-auto px-4 py-10 w-full">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-[#3E3E3A] bg-[#161615]">
        <div class="max-w-6xl mx-auto px-4 py-6
                    flex flex-col sm:flex-row
                    items-center justify-between gap-4
                    text-sm text-[#A1A09A]">

            {{-- Texto --}}
            <p>
                © {{ date('Y') }} Organizador de Eventos. Todos os direitos reservados.
            </p>

            {{-- Links --}}
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-[#EDEDEC] transition">
                    Sobre
                </a>
                <a href="#" class="hover:text-[#EDEDEC] transition">
                    Contato
                </a>
                <a href="#" class="hover:text-[#EDEDEC] transition">
                    Termos
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
