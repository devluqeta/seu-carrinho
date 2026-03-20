<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2 class="text-xl font-bold mb-4">Lista</h2>

<div class="mb-4">
    <input type="text" id="input-item" placeholder="Digite um item..."
        onkeyup="buscarAlimentos(this.value)"
        class="w-full border p-3 rounded-xl">
    <div id="autocomplete" class="bg-white border mt-1 rounded-xl"></div>
</div>

<div class="flex gap-2 mb-4">
    <input type="text" id="quantidade" placeholder="Qtd"
        class="border p-3 rounded-xl w-24">

    <button onclick="addItem()"
        class="bg-black text-white px-4 rounded-xl">Adicionar</button>
</div>

<div id="lista-itens">
    <?php foreach ($items as $item): ?>
        <div class="flex justify-between items-center mb-2">

            <label class="flex items-center gap-2">
                <input type="checkbox"
                    onchange="checkItem(<?= $item['id'] ?>, this.checked)"
                    <?= $item['checked'] ? 'checked' : '' ?>>

                <?= $item['name'] ?> (<?= $item['quantity'] ?>)
            </label>

            <button onclick="deleteItem(<?= $item['id'] ?>)">❌</button>

        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>