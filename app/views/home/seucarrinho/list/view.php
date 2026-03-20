<?php include __DIR__ . '/../layout/header.php'; ?>

<?php
// Buscar lista e itens
$listId = $_GET['id'] ?? null;
if (!$listId) {
    die('Lista não encontrada');
}

$model = new ListModel();
$list = $model->find($listId);

if (!$list || $list['user_id'] != $_SESSION['user']['id']) {
    die('Acesso negado');
}

// Simulação de itens (você pode ter um ItemModel real)
$items = $model->getItems($listId); // ou array() se não tiver
?>

<div class="container pb-5">
    <h2 class="fw-bold mb-4"><?= htmlspecialchars($list['name']) ?></h2>

    <!-- PROGRESSO -->
    <?php if ($list['expires_at']): ?>
        <?php
        $total = strtotime($list['expires_at']) - strtotime($list['created_at']);
        $restante = strtotime($list['expires_at']) - time();
        $percent = max(0, min(100, ($restante / $total) * 100));
        ?>
        <div class="mb-3">
            <div class="d-flex justify-content-between small">
                <span>Tempo restante</span>
                <span class="fw-bold text-danger">
                    Expira em: <?= date('d/m H:i', strtotime($list['expires_at'])) ?>
                </span>
            </div>
            <div class="progress">
                <div class="progress-bar bg-danger" style="width: <?= $percent ?>%"></div>
            </div>
        </div>
    <?php endif; ?>

    <!-- BOTÃO MODO VISUALIZAÇÃO -->
    <a href="/seucarrinho/list/view-mode/<?= $list['id'] ?>" class="btn btn-sm btn-outline-primary mb-4">
        👁 Modo Visualização
    </a>

    <!-- FORMULÁRIO DE ITENS -->
    <div class="card p-4 shadow-sm">
        <form action="/seucarrinho/list/items/store" method="POST" class="row g-3">
            <input type="hidden" name="list_id" value="<?= $list['id'] ?>">

            <div class="col-md-8">
                <input type="text" name="item_name" class="form-control" placeholder="Nome do item" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100">Adicionar Item</button>
            </div>
        </form>
    </div>

    <!-- LISTA DE ITENS -->
    <div class="mt-4">
        <?php if ($items): ?>
            <ul class="list-group">
                <?php foreach ($items as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['name']) ?>
                        <form action="/seucarrinho/list/items/delete" method="POST" class="m-0 p-0">
                            <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-muted">Nenhum item na lista ainda.</p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>