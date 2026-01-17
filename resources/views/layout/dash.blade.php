{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @hasSection('title')
                @yield('title') - {{ config('app.name', 'Laravel') }}
            @else
                {{ config('app.name', 'Laravel') }}
            @endif
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                /* (pode manter exatamente o mesmo CSS gigante que você já tinha aqui) */
            </style>
        @endif
    </head>

    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
        <div class="flex min-h-screen">

            {{-- SIDEBAR --}}
            <aside class="hidden lg:flex lg:flex-col w-64 bg-[#FDFDFC] dark:bg-[#161615] border-r border-[#e3e3e0] dark:border-[#3E3E3A]">
                <div class="h-14 flex items-center px-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <a href="{{ route('dashboard') }}" class="font-semibold text-sm tracking-tight dark:text-[#EDEDEC]">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <nav class="flex-1 px-3 py-4 text-sm">
                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-sm mb-1 leading-normal
                               border border-transparent
                               hover:border-[#19140035] dark:hover:border-[#3E3E3A]
                               {{ request()->routeIs('dashboard') ? 'bg-[#dbdbd7] dark:bg-[#3E3E3A]' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    {{-- Exemplo de outros links do menu --}}
                    <a
                        href="#"
                        class="flex items-center gap-2 px-3 py-2 rounded-sm mb-1 leading-normal
                               border border-transparent
                               hover:border-[#19140035] dark:hover:border-[#3E3E3A]">
                        <span>Usuários</span>
                    </a>

                    <a
                        href="#"
                        class="flex items-center gap-2 px-3 py-2 rounded-sm mb-1 leading-normal
                               border border-transparent
                               hover:border-[#19140035] dark:hover:border-[#3E3E3A]">
                        <span>Relatórios</span>
                    </a>
                </nav>

                {{-- Rodapé da sidebar (opcional) --}}
                <div class="px-6 py-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] text-xs text-[#706f6c] dark:text-[#A1A09A]">
                    © {{ date('Y') }} {{ config('app.name') }}
                </div>
            </aside>

            {{-- CONTAINER PRINCIPAL (TOPBAR + CONTENT) --}}
            <div class="flex-1 flex flex-col">

                {{-- TOPBAR --}}
                <header class="h-14 flex items-center justify-between px-4 lg:px-8 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FDFDFC] dark:bg-[#0a0a0a]">
                    {{-- Lado esquerdo: logo / nome + botão menu mobile --}}
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="lg:hidden inline-flex items-center justify-center w-8 h-8 rounded-sm border border-[#19140035] dark:border-[#3E3E3A]"
                            aria-label="Abrir menu"
                        >
                            {{-- Ícone hambúrguer simples --}}
                            <span class="w-4 h-[1px] bg-[#1b1b18] dark:bg-[#EDEDEC] block mb-1"></span>
                            <span class="w-4 h-[1px] bg-[#1b1b18] dark:bg-[#EDEDEC] block mb-1"></span>
                            <span class="w-4 h-[1px] bg-[#1b1b18] dark:bg-[#EDEDEC] block"></span>
                        </button>

                        <a href="{{ route('dashboard') }}" class="lg:hidden font-medium text-sm dark:text-[#EDEDEC]">
                            {{ config('app.name', 'Laravel') }}
                        </a>

                        @hasSection('title')
                            <h1 class="hidden lg:block text-sm font-medium dark:text-[#EDEDEC]">
                                @yield('title')
                            </h1>
                        @endif
                    </div>

                    {{-- Lado direito: usuário / ações --}}
                    <div class="flex items-center gap-3 text-sm">
                        @auth
                            <div class="hidden sm:flex flex-col items-end mr-2">
                                <span class="font-medium text-[#1b1b18] dark:text-[#EDEDEC] leading-normal">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="text-[13px] leading-[20px] text-[#706f6c] dark:text-[#A1A09A]">
                                    {{ Auth::user()->email }}
                                </span>
                            </div>

                            {{-- Avatar simples com iniciais --}}
                            <div class="w-8 h-8 rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] flex items-center justify-center text-xs font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            {{-- Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 border border-[#19140035] dark:border-[#3E3E3A] rounded-sm text-[13px] leading-[20px]
                                           hover:border-black dark:hover:border-white
                                           hover:bg-black dark:hover:bg-white
                                           hover:text-white dark:hover:text-[#1C1C1A]
                                    "
                                >
                                    Sair
                                </button>
                            </form>
                        @endauth
                    </div>
                </header>

                {{-- CONTEÚDO --}}
                <main class="flex-1 p-6 lg:p-8">
                    @yield('content')
                </main>

            </div>
        </div>
        @stack('scripts')
    </body>
</html>
