<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function mostrarSucesso(mensagem) {
        document.getElementById('modal-sucesso-texto').innerText = mensagem;
        openModal('modal-sucesso');
    }

    function salvarCriarLista() {
        closeModal('modal-nova-lista');
        mostrarSucesso('Lista criada com sucesso!');
    }

    // navegação
    function abrirLista(nome) {
        document.getElementById('view-home').classList.add('hidden');
        document.getElementById('view-list').classList.remove('hidden');

        document.getElementById('topbar-actions-home').classList.add('hidden');
        document.getElementById('topbar-actions-list').classList.remove('hidden');

        document.getElementById('header-subtitle').innerText = "Editando Lista";
    }

    function voltarParaHome() {
        document.getElementById('view-list').classList.add('hidden');
        document.getElementById('view-home').classList.remove('hidden');

        document.getElementById('topbar-actions-list').classList.add('hidden');
        document.getElementById('topbar-actions-home').classList.remove('hidden');

        document.getElementById('header-subtitle').innerText = "Compra Inteligente";
    }
</script>