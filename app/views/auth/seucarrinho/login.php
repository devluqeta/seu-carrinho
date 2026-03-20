<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Seu Carrinho</title>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- CSS EXTERNO -->
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>

<body>

    <div class="container">
        <div class="logo-container">
            <img src="/assets/images/logoo_icon.png" alt="Logo">
            <h2>Seu<span>Carrinho</span></h2>
        </div>

        <p class="subtitle">Bem-vindo de volta! Entre na sua conta.</p>

        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:15px;">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="/seucarrinho/login" method="POST">

            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

            <div class="input-group">
                <label>E-mail</label>
                <div class="input-wrapper">
                    <input type="email" name="email" placeholder="Digite seu email" required>
                </div>
            </div>

            <div class="input-group">
                <label>Senha</label>
                <div class="input-wrapper">
                    <input type="password" name="password" class="password-input" placeholder="Digite sua senha" required>
                    <span class="toggle-password">
                        <i data-lucide="eye"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-primary">Entrar</button>
        </form>

        <p class="switch-form">
            Não tem uma conta? <a href="/seucarrinho/register">Cadastre-se</a>
        </p>
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