@extends('layout.dash')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

    {{-- HEADER --}}
    <div>
        <h1 class="text-xl lg:text-2xl font-semibold mb-1 dark:text-[#EDEDEC]">
            Olá, {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
            Aqui está um resumo do sistema hoje.
        </p>
    </div>

    {{-- CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] p-5 hover:shadow-md transition">
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Usuários</p>
            <h2 class="mt-2 text-2xl font-semibold">{{ $users->count() }}</h2>
        </div>

        <div class="rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] p-5 hover:shadow-md transition">
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Ativos</p>
            <h2 class="mt-2 text-2xl font-semibold">
                {{ $users->whereNotNull('email')->count() }}
            </h2>
        </div>

        <div class="rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] p-5 hover:shadow-md transition">
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Hoje</p>
            <h2 class="mt-2 text-2xl font-semibold">{{ now()->format('d/m') }}</h2>
        </div>

        <div class="rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] p-5 hover:shadow-md transition">
            <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Sistema</p>
            <h2 class="mt-2 text-2xl font-semibold">Online</h2>
        </div>

    </div>

    {{-- TABELA --}}
    <div class="rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615] overflow-hidden">

        <div class="flex items-center justify-between px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <h2 class="text-sm font-semibold dark:text-[#EDEDEC]">
                Usuários cadastrados
            </h2>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-[#f7f7f5] dark:bg-[#1C1C1A] text-[#706f6c] dark:text-[#A1A09A]">
                <tr>
                    <th class="text-left px-6 py-3 font-medium">Nome</th>
                    <th class="text-left px-6 py-3 font-medium">E-mail</th>
                    <th class="text-center px-6 py-3 font-medium w-40">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                <tr class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] hover:bg-[#f7f7f5] dark:hover:bg-[#1C1C1A] transition">
                    <td class="px-6 py-3 dark:text-[#EDEDEC] font-medium">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-3 text-[#706f6c] dark:text-[#A1A09A]">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                class="btn-open-edit-modal px-3 py-1.5 rounded-md text-xs
                                    border border-[#19140035] dark:border-[#3E3E3A]
                                    hover:bg-black hover:text-white dark:hover:bg-white
                                    dark:hover:text-[#1C1C1A] transition"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                            >
                                Editar
                            </button>

                            <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 rounded-md text-xs
                                        border border-red-500 text-red-500
                                        hover:bg-red-500 hover:text-white transition">
                                    Excluir
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-[#706f6c] dark:text-[#A1A09A]">
                        Nenhum usuário encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL --}}
<div id="editUserModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm">

    <div class="w-full max-w-md mx-4 bg-white dark:bg-[#161615]
                border border-[#e3e3e0] dark:border-[#3E3E3A]
                rounded-xl p-6 shadow-xl scale-95 opacity-0 transition-all duration-200"
         id="modalBox">

        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-sm font-semibold dark:text-[#EDEDEC]">Editar usuário</h2>
                <p class="text-xs text-[#706f6c] dark:text-[#A1A09A]">
                    Atualize os dados do usuário.
                </p>
            </div>
            <button id="closeEditModal" class="text-sm px-2 py-1 border rounded-md hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition">
                ✕
            </button>
        </div>

        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="text-xs text-[#706f6c] dark:text-[#A1A09A]">Nome</label>
                <input id="editUserName" name="name" required
                    class="w-full mt-1 px-3 py-2 text-sm rounded-md
                           border border-[#e3e3e0] dark:border-[#3E3E3A]
                           bg-white dark:bg-[#0a0a0a] dark:text-white
                           focus:outline-none focus:ring-2 focus:ring-black/50 dark:focus:ring-white/50">
            </div>

            <div class="mb-6">
                <label class="text-xs text-[#706f6c] dark:text-[#A1A09A]">E-mail</label>
                <input id="editUserEmail" name="email" type="email" required
                    class="w-full mt-1 px-3 py-2 text-sm rounded-md
                           border border-[#e3e3e0] dark:border-[#3E3E3A]
                           bg-white dark:bg-[#0a0a0a] dark:text-white
                           focus:outline-none focus:ring-2 focus:ring-black/50 dark:focus:ring-white/50">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" id="cancelEditModal"
                    class="px-4 py-2 text-xs border rounded-md hover:bg-gray-100 dark:hover:bg-[#1C1C1A] transition">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 text-xs rounded-md bg-black text-white dark:bg-white dark:text-black hover:opacity-90 transition">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const baseUpdateUrl = "{{ url('/users') }}";

    const modal = document.getElementById('editUserModal');
    const box   = document.getElementById('modalBox');
    const form  = document.getElementById('editUserForm');

    const inputName  = document.getElementById('editUserName');
    const inputEmail = document.getElementById('editUserEmail');

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        setTimeout(() => {
            box.classList.remove('scale-95','opacity-0');
            box.classList.add('scale-100','opacity-100');
        }, 10);
    }

    function closeModal() {
        box.classList.add('scale-95','opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 150);
    }

    document.querySelectorAll('.btn-open-edit-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            form.action = `${baseUpdateUrl}/${btn.dataset.id}`;
            inputName.value  = btn.dataset.name;
            inputEmail.value = btn.dataset.email;
            openModal();
        });
    });

    document.getElementById('closeEditModal').onclick  = closeModal;
    document.getElementById('cancelEditModal').onclick = closeModal;

    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

});
</script>
@endpush
