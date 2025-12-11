<?php
session_start();
include('verifica_login.php');
include "menu.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        /* === CARDS === */
        .card {
            border-radius: 14px;
            overflow: hidden;
        }
        .carousel-item {
            padding: 20px;
        }
        .btn-form {
            background-color: #008b4f;
            color: white;
            font-size: 18px;
            padding: 12px 20px;
            border-radius: 10px;
        }
        .btn-form:hover {
            background-color: #006e3e;
        }
        .school-card {
            background: #0051a8;
            color: white;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(100%);
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <!-- Boas-vindas -->
    <div class="text-center mb-4">
        <h2>Olá, <strong><?php echo $_SESSION['email']; ?></strong> 👋</h2>
        <p class="text-muted">Bem-vindo ao seu painel!</p>
    </div>

    <!-- Carrossel -->
    <div id="painelCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#painelCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#painelCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#painelCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">

            <!-- CARD 1 -->
            <div class="carousel-item active">
                <div class="card shadow-lg text-center p-4 mx-auto" style="max-width: 500px;">
                    <h3 class="mb-3">Formulário de Inscrição</h3>
                    <p>Preencha o formulário para participar do processo seletivo.</p>
                    <a href="formulario.php" class="btn btn-form">Acessar Formulário</a>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="carousel-item">
                <div class="card shadow-lg school-card text-center p-4 mx-auto" style="max-width: 500px;">
                    <h3 class="mb-3">EEEP Manoel Mano</h3>
                    <p>A <strong>Escola Estadual de Educação Profissional Manoel Mano</strong> 
                    está entre as <strong>100 melhores escolas do Brasil</strong>, destacando-se pela excelência e inovação.</p>
                    <p>Uma instituição focada no seu futuro e na formação cidadã.</p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="carousel-item">
                <div class="card shadow-lg text-center p-4 mx-auto" style="max-width: 500px;">
                    <h3 class="mb-3">Avisos</h3>
                    <p class="text-muted">Nenhum aviso no momento.</p>
                </div>
            </div>

        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#painelCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#painelCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
