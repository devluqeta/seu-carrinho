<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="bg-white p-6 rounded shadow">

    <h3 class="text-xl font-bold mb-4"><?= $list['name'] ?></h3>

    <form action="/items/store" method="POST" class="flex gap-2 mb-4 relative">

        <input type="hidden" name="list_id" value="<?= $list['id'] ?>">

        <input id="search" name="name" class="border p-2 flex-1 rounded" placeholder="Item...">

        <input name="quantity" class="border p-2 w-24 rounded" placeholder="Qtd">

        <button class="bg-green-500 text-white px-4 rounded">Add</button>

        <!-- AUTOCOMPLETE -->
        <div id="autocomplete" class="absolute bg-white shadow w-full top-12 hidden"></div>

    </form>

    <?php foreach ($items as $item): ?>

        <div class="flex justify-between border-b py-2">

            <span>
                <?= $item['name'] ?> (<?= $item['quantity'] ?> <?= $item['unit'] ?? '' ?>)
            </span>

            <form method="POST" action="/items/delete">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <input type="hidden" name="list_id" value="<?= $list['id'] ?>">
                <button class="text-red-500">X</button>
            </form>

        </div>

    <?php endforeach; ?>

</div>

<script>
    const input = document.getElementById('search');
    const box = document.getElementById('autocomplete');

    input.addEventListener('keyup', async () => {

        const q = input.value;

        if (q.length < 2) {
            box.classList.add('hidden');
            return;
        }

        const res = await fetch(`/foods?q=${q}`);
        const data = await res.json();

        box.innerHTML = '';
        box.classList.remove('hidden');

        data.forEach(food => {
            const div = document.createElement('div');
            div.innerText = food.name + ' (' + food.unit + ')';
            div.className = 'p-2 hover:bg-gray-100 cursor-pointer';

            div.onclick = () => {
                input.value = food.name;
                box.classList.add('hidden');
            };

            box.appendChild(div);
        });
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>