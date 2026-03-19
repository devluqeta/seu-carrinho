<?php include __DIR__ . '/../layouts/header.php'; ?>

<div id="view-home">

    <div class="flex items-center justify-between mb-4">

        <h2 class="text-2xl font-bold">Suas Listas</h2>

        <button class="btn-add-lista">
            <span class="btn-add-icon">+</span>
            <span class="btn-add-text">Criar Lista</span>
        </button>

    </div>

    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex items-start gap-3 mb-4">

        <div class="text-blue-500 text-xl mt-0.5">
            <i class="ph-fill ph-info"></i>
        </div>

        <p class="text-sm text-blue-900 leading-relaxed">
            Por segurança e limpeza do sistema, suas listas e seus itens serão
            <strong class="font-semibold">deletados permanentemente</strong>
            após a data e hora informadas em cada uma das listas.
        </p>

    </div>

    <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:border-brand-300 transition-colors cursor-pointer group">
        <div class="flex justify-between items-start mb-4">
            <div
                class="w-12 h-12 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform"> '_' <!-- vai ficar icones padrao do sistema -->
            </div>
            <div
                class="bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                <i class="ph ph-clock"></i> Expira em X dias
            </div>
        </div>
        <h3 class="text-lg font-semibold text-slate-800 mb-1">Nome da Lisra</h3>
        <div class="flex items-center justify-between mt-4 border-t border-slate-50 pt-4">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <i class="ph ph-check-circle text-brand-500 text-lg"></i> 0/0 itens pegos
            </div>
            <i class="ph-bold ph-caret-right text-slate-300 group-hover:text-brand-500"></i>
        </div>
    </div>

    <main class="flex-1 w-full max-w-2xl mx-auto p-5 pb-32">
        <div id="estado-vazio" class="text-center py-16 animate-fadeIn">
            <img src="https://illustrations.popsy.co/emerald/shopping-cart.svg" alt="Carrinho Vazio"
                class="h-48 mx-auto mb-6">
            <h3 class="text-xl font-semibold text-gray-800">Você não criou nenhuma lista.</h3>
            <p class="text-gray-500 mt-2">Crie uma nova lista e aproveite!</p>
        </div>
    </main>

</div>

<div id="view-list" class="hidden">
    <h2 class="text-xl font-bold">Lista</h2>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>