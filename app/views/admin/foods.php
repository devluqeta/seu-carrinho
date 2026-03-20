<?php include __DIR__ . '/../layouts/admin/header.php'; ?>

<div class="bg-white p-6 rounded shadow">

    <h3 class="text-xl font-bold mb-4">Autocomplete</h3>

    <form method="POST" action="/admin/foods/store" class="flex gap-2 mb-4">
        <input name="name" placeholder="Nome" class="border p-2 rounded">
        <select name="unit" class="border p-2 rounded">
            <option>un</option>
            <option>kg</option>
            <option>g</option>
            <option>l</option>
        </select>
        <button class="bg-blue-500 text-white px-4 rounded">Criar</button>
    </form>

    <?php foreach ($foods as $f): ?>
        <div class="flex justify-between border-b py-2">
            <?= $f['name'] ?> (<?= $f['unit'] ?>)
        </div>
    <?php endforeach; ?>

</div>

<?php include __DIR__ . '/../layouts/admin/footer.php'; ?>