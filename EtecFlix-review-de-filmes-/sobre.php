<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre - MeuSistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style-sobre.css">
</head>
<body>

<!-- Menu -->
<header>
  <div class="logo">EtecFlix</div>
  <nav>
    <ul>
      <li><a href="index.php" class="ativo">Início</a></li>
      <li><a href="sobre.php">Sobre</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </nav>
</header>

<!-- Seção principal -->
<section class="hero">
  <div class="container">
    <h1>Sobre o MeuSistema</h1>
    <p class="lead text-muted">
      Uma plataforma desenvolvida para fins didáticos, utilizando <strong>HTML, CSS, PHP e Bootstrap</strong>.
      Nosso objetivo é ensinar a criar interfaces modernas, responsivas e fáceis de usar.
    </p>
  </div>
</section>

<!-- Conteúdo -->
<div class="container my-5">
  <div class="row g-4 align-items-center">
    
    <!-- Texto -->
    <div class="col-md-6">
      <div class="card card-custom p-4">
        <h3 class="fw-bold">Nossa Missão</h3>
        <p>
          O <strong>MeuSistema</strong> nasceu como parte de um exercício prático em sala de aula,
          para mostrar como unir programação e design. Aqui você aprende na prática conceitos de:
        </p>
        <ul>
          <li>✔ Desenvolvimento front-end com HTML e CSS</li>
          <li>✔ Uso de frameworks como Bootstrap</li>
          <li>✔ Integração de páginas PHP</li>
          <li>✔ Criação de layouts responsivos</li>
        </ul>
        <p>
          Além disso, estamos construindo juntos um sistema que pode servir de base para projetos
          maiores no futuro!
        </p>
      </div>
    </div>

    <!-- Imagem -->
    <div class="col-md-6 text-center">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" 
           alt="Ilustração equipe" 
           class="img-fluid" style="max-width: 350px;">
    </div>

  </div>
</div>

<!-- Footer -->
<footer>
  © Etec MCM 2025 — Projeto Acadêmico de Sistemas Web I
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
