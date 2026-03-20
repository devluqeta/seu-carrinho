<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página Não Encontrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/assets/css/404.css">

</head>

<body>

    <div class="circles">
        <div class="circle" style="width: 400px; height: 400px; top: -100px; left: -100px;"></div>
        <div class="circle" style="width: 300px; height: 300px; bottom: -50px; right: -50px;"></div>
    </div>

    <div class="error-wrapper" id="parallax-scene">
        <div class="position-relative d-inline-block">
            <h1 class="error-code">404</h1>
            <i class="bi bi-ghost-fill ghost-icon"></i>
        </div>

        <div class="content-box">
            <h2>Página não encontrada!</h2>
            <p>Opa! O link que você seguiu parece ter sumido no mapa ou nunca existiu. Que tal voltar para um lugar seguro?</p>

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <button onclick="window.history.back();" class="btn-action">
                    <i class="bi bi-arrow-left"></i> Página Anterior
                </button>
                <a href="/" class="btn-action" style="background: rgba(255,255,255,0.05); box-shadow: none;">
                    <i class="bi bi-house"></i> Ir para a Home
                </a>
            </div>
        </div>
    </div>

    <script>
        // Função Inteligente de Histórico
        function goBackOrHome() {
            // Se houver histórico e o site de origem for o mesmo domínio
            if (document.referrer && document.referrer.includes(window.location.hostname)) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        // Efeito Parallax suave com o movimento do mouse
        document.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.02;
            const moveY = (e.clientY - window.innerHeight / 2) * 0.02;

            const scene = document.getElementById('parallax-scene');
            scene.style.transform = `translateX(${moveX}px) translateY(${moveY}px)`;
        });
    </script>

</body>

</html>