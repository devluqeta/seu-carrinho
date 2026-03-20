<?php include __DIR__ . '/../layouts/admin/header.php'; ?>

<div class="bg-white p-6 rounded shadow">

    <h3 class="text-xl font-bold mb-4">Sugestões</h3>

    <?php foreach ($suggestions as $s): ?>

        <div class="border p-4 mb-3 rounded">

            <p><b><?= $s['name'] ?></b> - <?= $s['user_name'] ?></p>

            <form method="POST" action="/admin/suggestions/approve" class="flex gap-2 mt-2">
                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                <input name="name" value="<?= $s['name'] ?>" class="border p-2 rounded">

                <select name="unit" class="border p-2 rounded">
                    <option>un</option>
                    <option>kg</option>
                    <option>g</option>
                </select>

                <button class="bg-green-500 text-white px-3 rounded">Aprovar</button>
            </form>

            <form method="POST" action="/admin/suggestions/deny" class="flex gap-2 mt-2">
                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                <input name="reason" placeholder="Motivo" class="border p-2 rounded">
                <button class="bg-red-500 text-white px-3 rounded">Negar</button>
            </form>

        </div>

    <?php endforeach; ?>

</div>

<?php include __DIR__ . '/../layouts/admin/footer.php'; ?>