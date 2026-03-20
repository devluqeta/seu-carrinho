<?php

$hash = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';

    if (!empty($senha)) {
        // ======================================
        // GERA HASH SEGURO (BCRYPT AUTOMÁTICO)
        // ======================================
        $hash = password_hash($senha, PASSWORD_DEFAULT);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerador de Hash de Senha</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg">

        <h1 class="text-2xl font-bold mb-6 text-center">
            Gerador de Hash Seguro
        </h1>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold mb-1">
                    Digite a senha
                </label>
                <input type="text"
                    name="senha"
                    required
                    class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-black outline-none"
                    placeholder="Digite a senha para gerar a hash">
            </div>

            <button type="submit"
                class="w-full bg-black text-white p-3 rounded-xl font-semibold hover:opacity-90 transition">
                Gerar Hash
            </button>
        </form>

        <?php if ($hash): ?>
            <div class="mt-6 bg-slate-100 p-4 rounded-xl">
                <p class="text-sm font-semibold mb-2">Hash gerada:</p>
                <textarea class="w-full p-2 text-xs rounded border"
                    rows="4"
                    readonly><?= htmlspecialchars($hash) ?></textarea>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>