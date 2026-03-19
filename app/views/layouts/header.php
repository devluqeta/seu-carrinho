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

    <!-- CSS PRINCIPAL-->
    <link rel="stylesheet" href="/assets/css/styles.css">

    <!-- BOTÃO CRIAR LISTAR-->
    <link rel="stylesheet" href="/assets/css/button_add.css">

</head>

<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <header class="glass sticky top-0 z-40 px-5 py-4 flex justify-between items-center no-print">
        <div class="flex items-center gap-2">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                <i class="ph-bold ph-shopping-cart text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tight text-slate-900 leading-none">Seu<span
                        class="text-brand-600">Carrinho</span></h1>
                <p class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold" id="header-subtitle">Compra
                    Inteligente</p>
            </div>
        </div>

        <div id="topbar-actions-home">
            <button onclick="openModal('modal-nova-lista')"
                class="bg-slate-900 text-white p-2.5 rounded-full hover:bg-slate-800 transition active:scale-95">
                <i class="ph ph-plus text-lg"></i>
            </button>
        </div>
        <div id="topbar-actions-list" class="hidden flex gap-3">
            <button onclick="window.print()"
                class="text-slate-600 bg-slate-100 p-2.5 rounded-full hover:bg-slate-200 transition active:scale-95 flex items-center justify-center">
                <i class="ph ph-printer text-lg"></i>
            </button>
            <button onclick="voltarParaHome()"
                class="bg-slate-200 text-slate-700 px-4 py-2 rounded-full font-medium text-sm hover:bg-slate-300 transition active:scale-95">
                Voltar
            </button>
        </div>
    </header>

    <div class="hidden print-only mb-6">
        <h1 class="text-2xl font-bold" id="print-title">Lista de Compras</h1>
        <p class="text-gray-500 text-sm">Gerado pelo sistema web. Válida até: <span id="print-date"></span></p>
    </div>

    <main class="flex-1 overflow-y-auto w-full max-w-2xl mx-auto p-5 pb-32">