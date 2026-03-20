<?php include __DIR__ . '/../layouts/header.php'; ?>

<div id="modal-sucesso"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white rounded-2xl p-6 w-[90%] max-w-sm shadow-xl text-center animate-slide-up">

        <!-- Ícone -->
        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
            <i class="ph-bold ph-check text-3xl text-green-500"></i>
        </div>

        <!-- Texto -->
        <h2 class="text-lg font-semibold text-slate-800 mb-2">
            Sucesso!
        </h2>

        <p id="modal-sucesso-texto" class="text-slate-500 text-sm mb-5">
            Operação realizada com sucesso.
        </p>

        <!-- Botão -->
        <button onclick="closeModal('modal-sucesso')"
            class="w-full bg-brand-500 text-white py-2.5 rounded-xl font-medium hover:bg-brand-600 transition active:scale-95">
            OK
        </button>

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>