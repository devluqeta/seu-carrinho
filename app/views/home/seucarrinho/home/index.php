<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container pb-5">

    <!-- BUSCA -->
    <div class="search-container animate__animated animate__fadeIn">
        <h2 class="fw-bold mb-4">Minhas Listas</h2>

        <form method="GET" class="position-relative">
            <input type="text" name="search" class="form-control search-input"
                placeholder="Pesquisar lista pelo nome..."
                value="<?= $_GET['search'] ?? '' ?>">
        </form>
    </div>

    <!-- CRIAR LISTA -->
    <div class="card p-4 mb-4 shadow-sm">
        <form action="/seucarrinho/lists/store" method="POST" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="name" class="form-control" placeholder="Nome da lista" required>
            </div>

            <div class="col-md-5">
                <input type="datetime-local" name="expires_at" class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Criar</button>
            </div>
        </form>
    </div>

    <div class="lists-wrapper">

        <?php foreach ($lists as $list): ?>
            <div class="list-card animate__animated animate__fadeInUp">

                <div class="d-flex justify-content-between align-items-start">

                    <!-- LINK PARA ABRIR LISTA -->
                    <div>
                        <form action="/seucarrinho/list/view" method="POST" class="text-decoration-none text-dark">
                            <input type="hidden" name="id" value="<?= $list['id'] ?>">
                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($list['name']) ?></h5>
                            <small class="text-muted">
                                Criada em <?= date('d/m/Y', strtotime($list['created_at'])) ?>
                            </small>
                        </form>
                    </div>

                    <div class="d-flex gap-2">
                        <!-- EDIT -->
                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="collapse"
                            data-bs-target="#edit-<?= $list['id'] ?>">
                            Editar
                        </button>

                        <!-- DELETE -->
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal<?= $list['id'] ?>">
                            Excluir
                        </button>
                    </div>
                </div>

                <!-- EDIT FORM -->
                <div class="collapse mt-3" id="edit-<?= $list['id'] ?>">
                    <form action="/seucarrinho/lists/update" method="POST" class="row g-2">
                        <input type="hidden" name="id" value="<?= $list['id'] ?>">

                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control"
                                value="<?= htmlspecialchars($list['name']) ?>">
                        </div>

                        <div class="col-md-5">
                            <input type="datetime-local" name="expires_at"
                                value="<?= $list['expires_at'] ? date('Y-m-d\TH:i', strtotime($list['expires_at'])) : '' ?>"
                                class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Salvar</button>
                        </div>
                    </form>
                </div>

                <!-- ITEMS -->
                <form action="/seucarrinho/list/view" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $list['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-outline-primary">👁 Abrir Lista</button>
                </form>

            </div>

            <!-- MODAL DELETE -->
            <div class="modal fade" id="deleteModal<?= $list['id'] ?>" tabindex="-1"
                aria-labelledby="deleteModalLabel<?= $list['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel<?= $list['id'] ?>">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir a lista <b><?= htmlspecialchars($list['name']) ?></b>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="/seucarrinho/lists/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $list['id'] ?>">
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>