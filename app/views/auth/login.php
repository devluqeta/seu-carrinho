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
    <title>Seu Carrinho - Login</title>
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
            <p class="subtitle">Bem-vindo(a) de volta! Entre na sua conta.</p>
            <form method="POST" action="/login">
                <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

                <div class="input-group">
                    <label>E-mail</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" placeholder="Digite seu email" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Senha</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="password-input" placeholder="••••••••" required>
                        <span class="toggle-password"><i data-lucide="eye"></i></span>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Entrar</button>
            </form>
            <p class="switch-form">
                Não tem uma conta? <a href="/register">Cadastre-se</a>
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