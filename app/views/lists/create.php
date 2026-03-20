<?php include __DIR__ . '/../layouts/header.php'; ?>

<div id="modal-nova-lista" class="fixed inset-0 z-50 hidden flex items-center justify-center">

    <!-- FUNDO -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"
        onclick="closeModal('modal-nova-lista')"></div>

    <!-- CARD -->
    <div class="bg-white max-w-md w-full mx-4 p-6 rounded-2xl relative z-10">

        <h3 class="text-xl font-bold mb-4">Nova Lista</h3>

        <form id="form-nova-lista" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nome da Lista
                </label>
                <input type="text" name="name" placeholder="Ex: Aniversário da Maria" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Data de Uso
                    </label>
                    <input type="date" name="date" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-brand-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Hora (Até)
                    </label>
                    <input type="time" name="time" required
                        class="w-full border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-brand-500 outline-none transition-all">
                </div>
            </div>

            <div class="bg-blue-50 text-blue-800 text-xs p-3 rounded-xl flex gap-2 items-start mt-2">
                <i class="ph-fill ph-info text-blue-500 text-lg"></i>
                <p>
                    Por segurança, esta lista será <strong>deletada automaticamente</strong>
                    após a data e hora informadas.
                </p>
            </div>

            <button type="button" onclick="salvarCriarLista()"
                class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl mt-4 hover:bg-brand-600 transition-colors active:scale-95 shadow-lg shadow-slate-900/20">
                Criar
            </button>
        </form>

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>