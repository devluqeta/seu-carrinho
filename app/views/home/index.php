<?php include __DIR__ . '/../layouts/user/header.php'; ?>

<div class="bg-white p-6 rounded shadow">

    <h3 class="text-xl font-bold mb-4">Suas Listas</h3>

    <form action="/lists/store" method="POST" class="flex gap-2 mb-4">
        <input name="name" class="border p-2 flex-1 rounded" placeholder="Nova lista">
        <button class="bg-blue-500 text-white px-4 rounded">Criar</button>
    </form>

    <div class="grid grid-cols-3 gap-4">

        <?php foreach ($lists as $list): ?>
            <div class="bg-gray-50 p-4 rounded shadow">

                <h4 class="font-bold"><?= $list['name'] ?></h4>

                <div class="flex justify-between mt-3">

                    <a href="/items?list_id=<?= $list['id'] ?>" class="text-blue-500">Abrir</a>

                    <form method="POST" action="/lists/delete">
                        <input type="hidden" name="id" value="<?= $list['id'] ?>">
                        <button class="text-red-500">Excluir</button>
                    </form>

                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div>

<?php include __DIR__ . '/../layouts/user/footer.php'; ?>