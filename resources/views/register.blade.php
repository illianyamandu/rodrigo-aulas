@extends('layout.app')

@section('content')
    <div
        class="w-full max-w-[448px] lg:w-[438px] bg-[#FDFDFC] dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] p-6 lg:p-8">
        <h1 class="text-xl font-medium mb-2 text-[#1b1b18] dark:text-[#EDEDEC]">
            Criar conta
        </h1>
        <p class="text-sm mb-6 text-[#706f6c] dark:text-[#A1A09A] leading-normal">
            Preencha os dados abaixo para criar sua conta.
        </p>

        {{-- Mensagem de erros de validação --}}
        @if ($errors->any())
            <div
                class="mb-4 bg-[#fff2f2] dark:bg-[#1D0002] border border-[#F53003] dark:border-[#FF4433] text-[#f53003] dark:text-[#F61500] text-sm rounded-sm px-5 py-2">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" class="space-y-4" action="{{ route('register.store') }}">
            @method('POST')
            @csrf

            {{-- Nome --}}
            <div>
                <label for="name" class="block text-[13px] mb-1 text-[#1b1b18] dark:text-[#EDEDEC] leading-[20px]">
                    Nome completo
                </label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    class="w-full border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm px-5 py-2 text-sm leading-normal bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] outline-none hover:border-[#19140035] dark:hover:border-[#62605b] transition-all">
            </div>

            {{-- E-mail --}}
            <div>
                <label for="email" class="block text-[13px] mb-1 text-[#1b1b18] dark:text-[#EDEDEC] leading-[20px]">
                    E-mail
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm px-5 py-2 text-sm leading-normal bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] outline-none hover:border-[#19140035] dark:hover:border-[#62605b] transition-all">
            </div>

            {{-- Senha --}}
            <div>
                <label for="password" class="block text-[13px] mb-1 text-[#1b1b18] dark:text-[#EDEDEC] leading-[20px]">
                    Senha
                </label>
                <input id="password" name="password" type="password" required
                    class="w-full border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm px-5 py-2 text-sm leading-normal bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] outline-none hover:border-[#19140035] dark:hover:border-[#62605b] transition-all">
            </div>

            {{-- Confirmação de senha --}}
            <div>
                <label for="password_confirmation"
                    class="block text-[13px] mb-1 text-[#1b1b18] dark:text-[#EDEDEC] leading-[20px]">
                    Confirmar senha
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm px-5 py-2 text-sm leading-normal bg-white dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] outline-none hover:border-[#19140035] dark:hover:border-[#62605b] transition-all">
            </div>

            <div class="flex items-center justify-between pt-2">
                <a class="text-[13px] text-[#706f6c] dark:text-[#A1A09A] underline underline-offset-4"
                    href="{{ route('login') }}">
                    Já tem uma conta? Entrar
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center cursor-pointer px-5 py-2 rounded-sm text-sm font-medium bg-[#1b1b18] text-white hover:bg-black dark:bg-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white border border-[#19140035] dark:border-[#eeeeec] transition-all">
                    Criar conta
                </button>
            </div>
        </form>
    </div>
@endsection
