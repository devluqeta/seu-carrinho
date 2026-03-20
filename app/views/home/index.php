<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>EasyApps | Ecossistema de Soluções</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/styles.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-grid-1x2-fill me-2"></i>EasyApps
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1 text-dark"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#seucarrinho">SeuCarrinho</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium px-3" href="#agendafacil">AgendaFácil</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero text-center text-lg-start">
        <div class="container hero-content">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                    <span class="badge bg-white text-primary border border-primary px-3 py-2 rounded-pill mb-4 shadow-sm">
                        ✨ Um ecossistema completo para você
                    </span>
                    <h1>Facilitando a sua vida, um clique por vez.</h1>
                    <p class="lead text-muted mb-5 px-lg-5">Conheça nossos sistemas projetados para acabar com a burocracia do seu dia a dia. Rápidos, responsivos e feitos pensando exclusivamente na sua experiência.</p>

                    <a href="#seucarrinho" class="btn btn-custom btn-carrinho me-sm-3 mb-3">
                        Explorar Sistemas <i class="bi bi-arrow-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="seucarrinho" class="system-showcase">
        <div class="container">
            <div class="system-card" data-aos="fade-up">
                <div class="row align-items-center reverse-mobile">
                    <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
                        <div class="system-badge badge-carrinho">
                            <i class="bi bi-basket2-fill me-1"></i> Já disponível
                        </div>
                        <h2 class="display-5 fw-bold mb-4">SeuCarrinho</h2>
                        <p class="text-muted fs-5 mb-4">A lista de supermercado mais inteligente e rápida que você já usou. Esqueça o papel e a caneta, ou os blocos de notas confusos do celular.</p>

                        <ul class="list-unstyled feature-list mb-5">
                            <li><i class="bi bi-check-circle-fill" style="color: var(--sys-carrinho);"></i> <strong>Sem Cadastros:</strong> Acesse, crie a lista e pronto.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: var(--sys-carrinho);"></i> <strong>Autodestruição:</strong> As listas somem após o uso, mantendo sua privacidade.</li>
                            <li><i class="bi bi-check-circle-fill" style="color: var(--sys-carrinho);"></i> <strong>Pronto para Impressão:</strong> Transforme em PDF com checklists.</li>
                        </ul>

                        <a href="/seucarrinho" class="btn btn-custom btn-carrinho w-100 w-sm-auto">
                            Acessar SeuCarrinho <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="mockup-container" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); display: flex; align-items: center; justify-content: center;">

                            <img src="/assets/images/logoo.png" alt="Logo">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="agendafacil" class="system-showcase pt-0">
        <div class="container">
            <div class="system-card" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                        <div class="mockup-container" style="background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);">
                            <i class="bi bi-calendar-event-fill text-info" style="opacity: 0.5; font-size: 8rem;"></i>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-5 order-1 order-lg-2 mb-5 mb-lg-0">
                        <div class="system-badge badge-agenda">
                            <i class="bi bi-rocket-takeoff-fill me-1"></i> Em Desenvolvimento
                        </div>
                        <h2 class="display-5 fw-bold mb-4">AgendaFácil</h2>
                        <p class="text-muted fs-5 mb-4">O fim da confusão de horários. Um sistema robusto para prestadores de serviço, clínicas e autônomos gerenciarem seus clientes com maestria.</p>

                        <ul class="list-unstyled feature-list mb-5">
                            <li><i class="bi bi-stars" style="color: var(--sys-agenda);"></i> <strong>Lembretes no WhatsApp:</strong> Reduza faltas com avisos automáticos.</li>
                            <li><i class="bi bi-stars" style="color: var(--sys-agenda);"></i> <strong>Link de Agendamento:</strong> Seu cliente escolhe o horário direto pelo link.</li>
                            <li><i class="bi bi-stars" style="color: var(--sys-agenda);"></i> <strong>Dashboard Financeiro:</strong> Saiba quanto você vai faturar na semana.</li>
                        </ul>

                        <button class="btn btn-custom btn-agenda w-100 w-sm-auto" disabled>
                            Lançamento em Breve <i class="bi bi-hourglass-split"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--portal-primary); color: white;">
        <div class="container text-center" data-aos="zoom-in">
            <h2 class="fw-bold mb-3">Pronto para otimizar sua rotina?</h2>
            <p class="mb-0 opacity-75 fs-5">Nossos sistemas são criados com as tecnologias mais modernas do mercado.</p>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <h4 class="fw-bold mb-3"><i class="bi bi-grid-1x2-fill me-2"></i>EasyApps</h4>
            <p class="text-secondary mb-0">&copy; 2026 EasyApps Soluções. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Inicializa as animações de rolagem
        AOS.init({
            once: true, // Anima apenas na primeira vez que rolar
            offset: 100, // Dispara a animação 100px antes do elemento aparecer
            duration: 800 // Duração da animação em milissegundos
        });

        // Efeito da Navbar ao rolar a página
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>