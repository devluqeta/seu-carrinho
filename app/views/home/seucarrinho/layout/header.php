<?php
$user = null;

if (isset($_SESSION['user']['id'])) {
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user']['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SeuCarrinho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="/assets/css/styles_seucarrinho.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/seucarrinho/home">
                <img src="/assets/images/logoo_icon.png" alt="Logo" class="logo-navbar">

                <span class="brand-text">
                    <span class="brand-seu">Seu</span><span class="brand-carrinho">Carrinho</span>
                </span>
            </a>

            <div class="d-flex gap-3">
                <button class="nav-icon-btn" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    data-bs-html="true" title="<b>Bem-vindo(a),</b><br> <?= htmlspecialchars($user['name'] ?? '') ?>!">
                    <i class="bi bi-person-circle"></i>
                </button>

                <div class="dropdown">
                    <button class="nav-icon-btn" data-bs-toggle="dropdown">
                        <i class="bi bi-gear-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 15px;">
                        <li><a class="dropdown-item p-2 rounded" href="#"><i class="bi bi-chat-left-dots me-2"></i> Sugestões</a></li>
                        <li><a class="dropdown-item p-2 rounded" href="#"><i class="bi bi-bell me-2"></i> Notificações</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item p-2 rounded text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>