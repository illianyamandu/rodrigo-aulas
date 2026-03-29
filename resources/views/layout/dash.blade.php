{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

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

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="h-full bg-[#FDFDFC] dark:bg-[#0a0a0a] text-white">
    <div class="flex h-full">

        {{-- OVERLAY MOBILE --}}
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"></div>

        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="fixed lg:static inset-y-0 left-0 z-50 w-64
               bg-[#FDFDFC] dark:bg-[#161615]
               border-r border-[#e3e3e0] dark:border-[#3E3E3A]
               transform -translate-x-full lg:translate-x-0
               transition-transform duration-200">

            <div class="h-14 flex items-center px-6 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <a href="{{ route('dashboard') }}" class="font-semibold text-sm dark:text-[#EDEDEC]">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <nav class="flex-1 px-3 py-4 text-sm space-y-1">

                @php
                    $linkBase = 'flex items-center gap-3 px-3 py-2 rounded-md transition';
                    $active = 'bg-[#e8e8e5] dark:bg-[#3E3E3A] font-medium';
                    $normal = 'hover:bg-[#f1f1ef] dark:hover:bg-[#2A2A28]';
                @endphp

                <a href="{{ route('dashboard') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $active : $normal }}">
                    Dashboard
                </a>

                <a href="{{ route('events') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('events') ? $active : $normal }}">
                    Registrar Evento
                </a>

                <a href="#" class="{{ $linkBase }} {{ $normal }}">
                    Usuários
                </a>

                <a href="#" class="{{ $linkBase }} {{ $normal }}">
                    Relatórios
                </a>
            </nav>

            <div
                class="px-6 py-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] text-xs text-[#706f6c] dark:text-[#A1A09A]">
                © {{ date('Y') }} {{ config('app.name') }}
            </div>
        </aside>

        {{-- CONTEÚDO --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- TOPBAR --}}
            <header
                class="h-14 flex items-center justify-between px-4 lg:px-8
                   border-b border-[#e3e3e0] dark:border-[#3E3E3A]
                   bg-white/80 dark:bg-[#0a0a0a]/80 backdrop-blur">

                <div class="flex items-center gap-3">
                    <button id="openSidebar"
                        class="lg:hidden w-9 h-9 flex items-center justify-center rounded-md
                               border border-[#19140035] dark:border-[#3E3E3A]">
                        ☰
                    </button>

                    @hasSection('title')
                        <h1 class="text-sm font-medium dark:text-[#EDEDEC]">
                            @yield('title')
                        </h1>
                    @endif
                </div>

                @auth
                    <div class="flex items-center gap-3 text-sm">

                        <div class="hidden sm:flex flex-col items-end">
                            <span class="font-medium dark:text-[#EDEDEC]">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-[#706f6c] dark:text-[#A1A09A]">{{ Auth::user()->email }}</span>
                        </div>

                        <div
                            class="w-9 h-9 rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A]
                            flex items-center justify-center text-xs font-semibold">
                            {{ strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="px-3 py-1.5 text-xs border rounded-md 
                               border-[#19140035] dark:border-[#3E3E3A]
                               hover:bg-black hover:text-white cursor-pointer
                               dark:hover:bg-white dark:hover:text-black transition">
                                Sair
                            </button>
                        </form>

                    </div>
                @endauth
            </header>

            {{-- PAGE CONTENT --}}
            <main class="flex-1 p-6 lg:p-8 overflow-y-auto">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- JS MOBILE SIDEBAR --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('openSidebar');

            function open() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function close() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            openBtn?.addEventListener('click', open);
            overlay?.addEventListener('click', close);
        });
    </script>

    @stack('scripts')
</body>

</html>
