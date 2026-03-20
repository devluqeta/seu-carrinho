<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Seu Carrinho | Compra Inteligente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            900: '#1e3a8a'
                        },
                        accent: {
                            400: '#f472b6',
                            500: '#ec4899'
                        }
                    },
                    boxShadow: {
                        'app': '0 -4px 20px rgba(0,0,0,0.05)',
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)'
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/button_add.css">
</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- HEADER / TOPBAR -->
    <header class="glass sticky top-0 z-40 px-5 py-4 flex flex-col md:flex-row justify-between items-center no-print gap-3">

        <!-- Logo e título -->
        <div class="flex items-center gap-2">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                <i class="ph-bold ph-shopping-cart text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-900 leading-none">Seu<span
                        class="text-brand-600">Carrinho</span></h1>
                <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold"
                    id="header-subtitle">Compra Inteligente</p>
            </div>
        </div>

        <!-- BOTÃO MOBILE MENU -->
        <div class="md:hidden flex items-center gap-2">
            <!-- Botão nova lista (somente usuário) -->
            <?php if ($_SESSION['user']['role'] !== 'admin'): ?>
                <button onclick="openModal('modal-nova-lista')"
                    class="bg-slate-900 text-white p-2.5 rounded-full hover:bg-slate-800 transition active:scale-95">
                    <i class="ph ph-plus text-lg"></i>
                </button>
            <?php endif; ?>

            <button id="mobileMenuButton" onclick="toggleMobileMenu()"
                class="text-slate-800 bg-gray-200 p-2 rounded hover:bg-gray-300 transition">
                <i class="ph ph-list text-lg"></i>
            </button>
        </div>

        <!-- LINKS / NOTIFICAÇÕES -->
        <div id="navLinks"
            class="hidden md:flex flex-col md:flex-row md:items-center gap-3 md:gap-2 w-full md:w-auto">

            <!-- Links de navegação -->
            <nav class="flex flex-col md:flex-row gap-2 md:gap-2">
                <a href="/" class="px-3 py-1 rounded hover:bg-gray-100 transition">Listas</a>

                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/admin" class="px-3 py-1 rounded hover:bg-gray-100 transition">Admin</a>
                    <a href="/admin/foods" class="px-3 py-1 rounded hover:bg-gray-100 transition">Autocomplete</a>
                    <a href="/admin/suggestions" class="px-3 py-1 rounded hover:bg-gray-100 transition">Sugestões</a>
                <?php endif; ?>

                <a href="/logout" class="px-3 py-1 text-red-500 hover:bg-red-50 rounded transition">Sair</a>
            </nav>

            <!-- Notificações -->
            <div class="relative mt-2 md:mt-0">
                <button onclick="toggleNotif()" class="relative px-3 py-1 rounded hover:bg-gray-100 transition">
                    🔔
                </button>

                <div id="notifBox" class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg rounded p-4">
                    <?php foreach ($notifications ?? [] as $n): ?>
                        <div class="border-b py-2 text-sm">
                            <?= htmlspecialchars($n['message']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Botão nova lista (somente usuário, desktop) -->
            <?php if ($_SESSION['user']['role'] !== 'admin'): ?>
                <button onclick="openModal('modal-nova-lista')"
                    class="bg-slate-900 text-white p-2.5 rounded-full hover:bg-slate-800 transition active:scale-95 hidden md:inline-flex">
                    <i class="ph ph-plus text-lg"></i>
                </button>
            <?php endif; ?>

        </div>
    </header>

    <script>
        function toggleMobileMenu() {
            const nav = document.getElementById('navLinks');
            nav.classList.toggle('hidden');
        }

        function toggleNotif() {
            const notif = document.getElementById('notifBox');
            notif.classList.toggle('hidden');
        }
    </script>

    <!-- PRINT HEADER -->
    <div class="hidden print-only mb-6">
        <h1 class="text-2xl font-bold" id="print-title">Lista de Compras</h1>
        <p class="text-gray-500 text-sm">Gerado pelo sistema web. Válida até: <span id="print-date"></span></p>
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto w-full max-w-2xl mx-auto p-5 pb-32">