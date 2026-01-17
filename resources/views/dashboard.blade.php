@extends('layout.dash')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-6xl mx-auto">

        {{-- Cabeçalho da página --}}
        <div class="mb-6 lg:mb-8">
            <h1 class="text-lg lg:text-2xl font-medium mb-1 dark:text-[#EDEDEC]">
                Olá, {{ Auth::user()->name }} 👋
            </h1>
            <p class="text-[13px] leading-[20px] text-[#706f6c] dark:text-[#A1A09A]">
                Aqui está um resumo rápido do que está acontecendo na aplicação hoje.
            </p>
        </div>

        {{-- Linha de listagem de usuários --}}
        <div class="border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] mb-8">
            <div class="flex items-center justify-between px-4 lg:px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                <h2 class="text-sm font-medium dark:text-[#EDEDEC]">
                    Usuários cadastrados
                </h2>

                {{-- <a href="#"
                class="text-[13px] px-3 py-1.5 border border-[#19140035] dark:border-[#3E3E3A]
                        rounded-sm hover:bg-black hover:text-white dark:hover:bg-white
                        dark:hover:text-[#1C1C1A] transition">
                    + Novo usuário
                </a> --}}
            </div>

            <table class="w-full text-left text-sm">
                <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                    <tr class="text-[13px] text-[#706f6c] dark:text-[#A1A09A]">
                        <th class="py-3 px-4 lg:px-6">Nome</th>
                        <th class="py-3 px-4 lg:px-6">E-mail</th>
                        <th class="py-3 px-4 lg:px-6 w-32 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                            <td class="py-3 px-4 lg:px-6 dark:text-[#EDEDEC]">
                                {{ $user->name }}
                            </td>
                            <td class="py-3 px-4 lg:px-6 text-[#706f6c] dark:text-[#A1A09A]">
                                {{ $user->email }}
                            </td>

                            <td class="py-3 px-4 lg:px-6 flex items-center justify-center gap-2">

                                {{-- Botão Editar -> abre modal --}}
                                <button
                                    type="button"
                                    class="btn-open-edit-modal text-[13px] px-2 py-1 rounded-sm border border-[#19140035] dark:border-[#3E3E3A]
                                        hover:bg-black hover:text-white dark:hover:bg-white
                                        dark:hover:text-[#1C1C1A] transition"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}"
                                >
                                    Editar
                                </button>

                                {{-- Botão Excluir --}}
                                <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-[13px] px-2 py-1 rounded-sm border border-[#f53003] text-[#f53003]
                                            hover:bg-[#f53003] hover:text-white
                                            dark:border-[#FF4433] dark:text-[#FF4433]
                                            dark:hover:bg-[#FF4433] dark:hover:text-white transition">
                                        Excluir
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    @if ($users->isEmpty())
                        <tr>
                            <td colspan="3" class="py-6 px-4 lg:px-6 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal de edição de usuário --}}
    <div
    id="editUserModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40"
    >
    <div class="w-full max-w-md mx-4 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm p-6 shadow-[0px_10px_25px_rgba(0,0,0,0.25)]">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-sm font-medium dark:text-[#EDEDEC]">
                    Editar usuário
                </h2>
                <p class="text-[13px] leading-[20px] text-[#706f6c] dark:text-[#A1A09A]">
                    Atualize as informações do usuário selecionado.
                </p>
            </div>
            <button
                type="button"
                id="closeEditModal"
                class="text-[13px] px-2 py-1 rounded-sm border border-[#19140035] dark:border-[#3E3E3A]
                    hover:bg-black text-white dark:hover:bg-white dark:hover:text-[#1C1C1A] transition"
            >
                Fechar
            </button>
        </div>

        <form id="editUserForm" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="editUserName" class="block text-[13px] mb-1 text-[#706f6c] dark:text-[#A1A09A]">
                    Nome
                </label>
                <input
                    type="text"
                    name="name"
                    id="editUserName"
                    class="w-full text-sm px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm
                        bg-white dark:bg-[#0a0a0a] dark:text-[#EDEDEC]
                        focus:outline-none focus:border-black dark:focus:border-white"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="editUserEmail" class="block text-[13px] mb-1 text-[#706f6c] dark:text-[#A1A09A]">
                    E-mail
                </label>
                <input
                    type="email"
                    name="email"
                    id="editUserEmail"
                    class="w-full text-sm px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm
                        bg-white dark:bg-[#0a0a0a] dark:text-[#EDEDEC]
                        focus:outline-none focus:border-black dark:focus:border-white"
                    required
                >
            </div>

            {{-- Se tiver mais campos do usuário, adiciona aqui --}}

            <div class="flex justify-end gap-2 mt-6">
                <button
                    type="button"
                    id="cancelEditModal"
                    class="text-[13px] px-3 py-1.5 rounded-sm border border-[#19140035] dark:border-[#3E3E3A]
                        hover:bg-black text-white dark:hover:bg-white dark:hover:text-[#1C1C1A] transition"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="text-[13px] px-3 py-1.5 rounded-sm border border-white
                         text-black bg-white 
                        hover:opacity-90 transition"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const baseUpdateUrl = "{{ url('/users') }}"; // monta /users/{id}

        const modal           = document.getElementById('editUserModal');
        const form            = document.getElementById('editUserForm');
        const inputName       = document.getElementById('editUserName');
        const inputEmail      = document.getElementById('editUserEmail');
        const closeBtn        = document.getElementById('closeEditModal');
        const cancelBtn       = document.getElementById('cancelEditModal');
        const editButtons     = document.querySelectorAll('.btn-open-edit-modal');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        editButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const id    = btn.dataset.id;
                const name  = btn.dataset.name;
                const email = btn.dataset.email;

                // Preenche os campos
                inputName.value  = name;
                inputEmail.value = email;

                // Define a action do form: /users/{id}
                form.action = `${baseUpdateUrl}/${id}`;

                openModal();
            });
        });

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        // Fecha ao clicar fora do conteúdo
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Fecha com ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
@endpush
