<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - EtecFlix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">EtecFlix</div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="sobre.php" class="ativo">Sobre</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Sobre o EtecFlix</h1>
                <p class="lead">Conheça mais sobre nossa plataforma de avaliação de filmes</p>
            </div>
        </div>
    </section>

    <!-- Conteúdo Sobre -->
    <section class="filmes-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="card-custom p-4">
                        <h3>Nossa Missão</h3>
                        <p>
                            O <strong>EtecFlix</strong> nasceu como parte de um exercício prático em sala de aula,
                            para mostrar como unir programação e design. Aqui você aprende na prática conceitos de:
                        </p>
                        <ul class="lista-sobre">
                            <li><i class="fas fa-check text-success"></i> Desenvolvimento front-end com HTML e CSS</li>
                            <li><i class="fas fa-check text-success"></i> Uso de frameworks como Bootstrap</li>
                            <li><i class="fas fa-check text-success"></i> Integração de páginas PHP</li>
                            <li><i class="fas fa-check text-success"></i> Criação de layouts responsivos</li>
                            <li><i class="fas fa-check text-success"></i> Sistema de banco de dados</li>
                            <li><i class="fas fa-check text-success"></i> Desenvolvimento full-stack</li>
                        </ul>
                        <p>
                            Além disso, estamos construindo juntos um sistema que pode servir de base para projetos
                            maiores no futuro!
                        </p>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" 
                         alt="Ilustração equipe" 
                         class="img-fluid" style="max-width: 350px;">
                </div>
            </div>

            <!-- Recursos -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="text-center mb-4">Recursos da Plataforma</h3>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-film fa-3x text-primary mb-3"></i>
                        <h5>Catálogo de Filmes</h5>
                        <p>Explore nossa coleção de filmes com informações detalhadas e avaliações da comunidade.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-star fa-3x text-warning mb-3"></i>
                        <h5>Sistema de Avaliação</h5>
                        <p>Avalie filmes com notas de 1 a 5 estrelas e compartilhe suas opiniões com outros usuários.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-users-cog fa-3x text-success mb-3"></i>
                        <h5>Painel Administrativo</h5>
                        <p>Interface completa para gerenciar filmes, usuários e avaliações do sistema.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Desenvolvido por João Henrique de Andrade Gimenes</p>
            <p>Projeto Acadêmico - Sistemas Web I</p>
        </div>
    </footer>

    <style>
        .lista-sobre {
            list-style: none;
            padding-left: 0;
        }
        .lista-sobre li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .lista-sobre li:last-child {
            border-bottom: none;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background: #fff;
        }
    </style>

    <script src="script.js"></script>
</body>
</html>