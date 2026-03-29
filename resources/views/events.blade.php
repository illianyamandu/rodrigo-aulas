@extends('layout.dash')

@section('title', 'Registrar Evento')

@section('content')
    <div class="max-w-3xl mx-auto">

        {{-- Card --}}
        <div class="bg-[#161615] border border-[#3E3E3A] rounded-lg shadow-lg p-6 lg:p-8">

            {{-- Título --}}
            <h1 class="text-xl font-semibold text-[#EDEDEC] mb-6">
                Registrar novo evento
            </h1>

            {{-- Form --}}
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Imagem --}}
                <div>
                    <label for="image" class="block text-sm mb-1 text-[#EDEDEC]">
                        Imagem do evento
                    </label>
                    <input type="file" name="image" id="image" required
                        class="w-full text-sm text-[#EDEDEC] file:cursor-pointer file:mr-4 file:px-4 file:py-2
                           file:rounded-sm file:border-0 file:bg-[#2A2A28] file:text-[#EDEDEC]
                           hover:file:bg-[#3A3A38] border border-[#3E3E3A] rounded-sm bg-[#0F0F0E]">
                </div>

                {{-- Nome --}}
                <div>
                    <label for="name" class="block text-sm mb-1 text-[#EDEDEC]">
                        Nome do evento
                    </label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 text-sm
                           bg-[#0F0F0E] text-[#EDEDEC]
                           border border-[#3E3E3A] rounded-sm
                           outline-none
                           focus:border-[#EDEDEC] transition">
                </div>

                {{-- Horário --}}
                <div>
                    <label for="time" class="block text-sm mb-1 text-[#EDEDEC]">
                        Horário do evento
                    </label>
                    <input type="time" name="time" id="time" required
                        class="w-full px-4 py-2 text-sm
                           bg-[#0F0F0E] text-[#EDEDEC]
                           border border-[#3E3E3A] rounded-sm
                           outline-none
                           focus:border-[#EDEDEC] transition">
                </div>

                {{-- Data --}}
                <div>
                    <label for="date" class="block text-sm mb-1 text-[#EDEDEC]">
                        Data do evento
                    </label>
                    <input type="date" name="date" id="date" required
                        class="w-full px-4 py-2 text-sm
                           bg-[#0F0F0E] text-[#EDEDEC]
                           border border-[#3E3E3A] rounded-sm
                           outline-none
                           focus:border-[#EDEDEC] transition">
                </div>

                {{-- Local --}}
                <div>
                    <label for="location" class="block text-sm mb-1 text-[#EDEDEC]">
                        Local do evento
                    </label>
                    <input type="text" name="location" id="location" required
                        class="w-full px-4 py-2 text-sm
                           bg-[#0F0F0E] text-[#EDEDEC]
                           border border-[#3E3E3A] rounded-sm
                           outline-none
                           focus:border-[#EDEDEC] transition">
                </div>

                {{-- Descrição --}}
                <div>
                    <label for="description" class="block text-sm mb-1 text-[#EDEDEC]">
                        Descrição do evento
                    </label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-4 py-2 text-sm
                           bg-[#0F0F0E] text-[#EDEDEC]
                           border border-[#3E3E3A] rounded-sm
                           outline-none
                           focus:border-[#EDEDEC] transition"></textarea>
                </div>

                {{-- Ações --}}
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="inline-flex items-center gap-2
                           px-6 py-2 text-sm font-medium
                           rounded-sm cursor-pointer
                           bg-[#EDEDEC] text-[#1C1C1A]
                           hover:bg-white
                           transition">
                        Registrar evento
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
