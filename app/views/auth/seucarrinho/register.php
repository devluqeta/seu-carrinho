<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Seu Carrinho</title>
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

        <p class="subtitle">Crie sua conta para começar.</p>

        <?php if (!empty($_SESSION['error'])): ?>
            <div style="background:#fee2e2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:15px;">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="/seucarrinho/register" method="POST">

            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">

            <div class="name-grid">
                <div class="input-group">
                    <label>Nome</label>
                    <div class="input-wrapper">
                        <input type="text" name="first_name" placeholder="Digite seu nome" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Sobrenome</label>
                    <div class="input-wrapper">
                        <input type="text" name="last_name" placeholder="Digite seu sobrenome" required>
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
                    <input type="password" name="password" id="password" class="password-input" placeholder="Crie sua senha" required>
                    <span class="toggle-password">
                        <i data-lucide="eye"></i>
                    </span>
                </div>

                <!-- FORA DO WRAPPER -->
                <div class="password-rules" id="password-rules">
                    <p id="rule-length">• Mínimo de 8 caracteres</p>
                    <p id="rule-upper">• Letra maiúscula</p>
                    <p id="rule-lower">• Letra minúscula</p>
                    <p id="rule-number">• Número</p>
                    <p id="rule-special">• Caractere especial</p>
                </div>
            </div>

            <button type="submit" class="btn-primary">Criar Conta</button>
        </form>

        <p class="switch-form">
            Já possui conta? <a href="/seucarrinho/login">Fazer Login</a>
        </p>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const rulesBox = document.getElementById('password-rules');

        const rules = {
            length: document.getElementById('rule-length'),
            upper: document.getElementById('rule-upper'),
            lower: document.getElementById('rule-lower'),
            number: document.getElementById('rule-number'),
            special: document.getElementById('rule-special'),
        };

        // Mostrar regras ao focar
        passwordInput.addEventListener('focus', () => {
            rulesBox.style.display = 'block';
        });

        // Validar enquanto digita
        passwordInput.addEventListener('input', () => {
            const value = passwordInput.value;

            // Regras
            const validations = {
                length: value.length >= 8,
                upper: /[A-Z]/.test(value),
                lower: /[a-z]/.test(value),
                number: /[0-9]/.test(value),
                special: /[^A-Za-z0-9]/.test(value),
            };

            // Atualizar UI
            for (let key in validations) {
                if (validations[key]) {
                    rules[key].classList.add('valid');
                } else {
                    rules[key].classList.remove('valid');
                }
            }
        });
    </script>

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