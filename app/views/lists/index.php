<input type="text" id="food-input" placeholder="Digite um item...">
<input type="hidden" name="food_id" id="food-id">

<ul id="suggestions"></ul>

<script>
    const input = document.getElementById('food-input');
    const list = document.getElementById('suggestions');

    input.addEventListener('input', async () => {
        const res = await fetch('/foods?q=' + input.value);
        const data = await res.json();

        list.innerHTML = '';

        data.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.name + ' (' + item.unit + ')';

            li.onclick = () => {
                input.value = item.name;
                document.getElementById('food-id').value = item.id;
                list.innerHTML = '';
            };

            list.appendChild(li);
        });
    });
</script>