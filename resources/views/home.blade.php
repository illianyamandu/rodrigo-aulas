@extends('layout.home')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Título --}}
    <div class="mb-10">
        <h1 class="text-3xl font-semibold text-[#EDEDEC] tracking-tight">
            Eventos
        </h1>
        <p class="text-sm text-[#A1A09A] mt-1">
            Confira os próximos eventos disponíveis
        </p>
    </div>

    {{-- Grid de eventos --}}
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($events as $event)
            <div
                class="group bg-[#161615] border border-[#3E3E3A] rounded-xl overflow-hidden
                       shadow-sm hover:shadow-lg hover:border-[#62605b]
                       transition-all duration-300">

                {{-- Imagem --}}
                @if ($event->image)
                    <div class="relative overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $event->image) }}"
                            alt="{{ $event->name }}"
                            class="w-full h-44 object-cover
                                   transition-transform duration-300
                                   group-hover:scale-105">
                    </div>
                @endif

                {{-- Conteúdo --}}
                <div class="p-5 space-y-3">

                    {{-- Nome --}}
                    <h2 class="text-lg font-semibold text-[#EDEDEC] leading-tight">
                        {{ $event->name }}
                    </h2>

                    {{-- Data / Hora / Local --}}
                    <div class="text-sm text-[#A1A09A] flex flex-wrap gap-2 items-center">
                        <span class="flex items-center gap-1">
                            📅 {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                        </span>
                        <span class="opacity-40">•</span>
                        <span class="flex items-center gap-1">
                            ⏰ {{ $event->time }}
                        </span>
                        <span class="opacity-40">•</span>
                        <span class="flex items-center gap-1">
                            📍 {{ $event->location }}
                        </span>
                    </div>

                    {{-- Descrição --}}
                    <p class="text-sm text-[#D1D1CD] leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($event->description, 110) }}
                    </p>

                    {{-- Ação --}}
                    <div class="pt-3">
                        <button
                            class="w-full text-sm font-medium px-4 py-2 rounded-md
                                   bg-[#1b1b18] text-[#EDEDEC]
                                   border border-[#3E3E3A]
                                   hover:bg-black hover:border-[#62605b]
                                   transition">
                            Ver detalhes
                        </button>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-[#A1A09A] col-span-full text-center">
                Nenhum evento cadastrado.
            </p>
        @endforelse
    </div>
</div>
@endsection
