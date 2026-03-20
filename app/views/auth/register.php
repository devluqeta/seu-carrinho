<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Carrinho - Registro</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>

<body>

    <div class="container">
        <div class="logo-container">
            <img src="/assets/images/logoo_icon.png" alt="Logo Seu Carrinho">
            <h2>Seu<span>Carrinho</span></h2>

            <?php if (!empty($_SESSION['error'])): ?>
                <p style="color:red"><?= $_SESSION['error'];
                                        unset($_SESSION['error']); ?></p>
            <?php endif; ?>
        </div>

        <div class="form-box active">
            <p class="subtitle">Crie sua conta para começar a usar as listas inteligentes!</p>
            <form method="POST" action="/register">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

                <div class="name-grid">
                    <div class="input-group">
                        <label>Nome</label>
                        <div class="input-wrapper">
                            <input type="text" name="name" placeholder="Seu nome" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Sobrenome</label>
                        <div class="input-wrapper">
                            <input type="text" name="lastname" placeholder="Seu sobrenome" required>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label>E-mail</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" placeholder="Digite seu email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Senha</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="password-input" placeholder="Crie sua senha" required>
                        <span class="toggle-password"><i data-lucide="eye"></i></span>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Criar Conta</button>
            </form>
            <p class="switch-form">
                Já possui conta? <a href="/login">Fazer Login</a>
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.password-input');
                const icon = this.querySelector('i');
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
                lucide.createIcons();
            });
        });
    </script>

</body>

</html>