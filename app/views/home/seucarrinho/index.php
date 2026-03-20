<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MercadoExpress | Lista Inteligente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- CSS PRINCIPAL -->
 <link rel="stylesheet" href="/assets/css/seucarrinho.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="/assets/images/logoo_icon.png" alt="Logo" class="logo-navbar">
                Seu<span>Carrinho</span>
            </a>
        </div>
    </nav>
    <section class="hero">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-lg-5 mb-5 mb-lg-0">
                    <h1>Compras sem complicação.</h1>
                    <p>Crie sua lista de supermercado em segundos. Adicione itens, marque o que já pegou e não esqueça de nada. Tudo direto do seu celular.</p>

                    <div class="row features-row g-4 mt-2 d-none d-md-flex">
                        <div class="col-6">
                            <div class="feature-icon"><i class="bi bi-phone"></i></div>
                            <div class="feature-title">100% Mobile</div>
                            <div class="feature-text">Feito para usar com uma mão só no corredor do mercado.</div>
                        </div>
                        <div class="col-6">
                            <div class="feature-icon"><i class="bi bi-incognito"></i></div>
                            <div class="feature-title">Sem Cadastro</div>
                            <div class="feature-text">Sua lista se autodestrói após o prazo. Zero spam no seu email.</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-5">
                    <div class="quick-create-card text-center">
                        <h4 class="fw-bold mb-3">Crie sua lista agora</h4>

                        <p class="text-muted mb-4">
                            Para criar e salvar suas listas, você precisa de uma conta.
                            Leva menos de 30 segundos!
                        </p>

                        <a href="/seucarrinho/register" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            Criar Conta <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <p class="mt-3 small text-muted">
                            Já tem conta?
                            <a href="/seucarrinho/login" class="fw-semibold text-decoration-none">Fazer login</a>
                        </p>
                    </div>
                </div>

            </div>

            <div class="row features-row g-4 mt-5 d-flex d-md-none px-2">
                <div class="col-12 d-flex align-items-start gap-3">
                    <div class="feature-icon flex-shrink-0"><i class="bi bi-phone"></i></div>
                    <div>
                        <div class="feature-title">Feito para o celular</div>
                        <div class="feature-text">Interface pensada para uso rápido no mercado.</div>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-start gap-3 mt-3">
                    <div class="feature-icon flex-shrink-0"><i class="bi bi-printer"></i></div>
                    <div>
                        <div class="feature-title">Pronto para imprimir</div>
                        <div class="feature-text">Gere um PDF perfeito com checkboxes para marcar com caneta.</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>