<?php
session_start();
require_once '../../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: index.php?erro=ID do filme não especificado');
    exit();
}

$pdo = getDBConnection();
$filme_id = $_GET['id'];

// Buscar informações do filme
$stmt = $pdo->prepare("SELECT * FROM filmes WHERE id = ? AND ativo = TRUE");
$stmt->execute([$filme_id]);
$filme = $stmt->fetch();

if (!$filme) {
    header('Location: index.php?erro=Filme não encontrado');
    exit();
}

// Processar exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE filmes SET ativo = FALSE WHERE id = ?");
        $stmt->execute([$filme_id]);
        
        header('Location: index.php?sucesso=Filme excluído com sucesso!');
        exit();
    } catch (PDOException $e) {
        $erro = 'Erro ao excluir filme: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Filme - EtecFlix Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">EtecFlix Admin</div>
        <nav>
            <ul>
                <li><a href="../../index.php">Início Site</a></li>
                <li><a href="../index.php">Painel Admin</a></li>
                <li><a href="../../login.php?logout=true">Sair</a></li>
            </ul>
        </nav>
    </header>

    <!-- Admin Container -->
    <div class="admin-container">
        <div class="container">
            <div class="admin-header">
                <h2 class="admin-title">Excluir Filme</h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <div class="card-custom p-4">
                <div class="text-center mb-4">
                    <img src="<?= htmlspecialchars($filme['poster_url']) ?>" 
                         alt="<?= htmlspecialchars($filme['titulo']) ?>" 
                         class="rounded mb-3" 
                         style="width: 200px; height: 300px; object-fit: cover;">
                    <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
                    <p class="text-muted"><?= $filme['ano_lancamento'] ?> • <?= htmlspecialchars($filme['genero']) ?></p>
                </div>

                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle"></i> Atenção!</h5>
                    <p class="mb-0">Você está prestes a excluir o filme "<strong><?= htmlspecialchars($filme['titulo']) ?></strong>". Esta ação não pode ser desfeita. Todas as avaliações relacionadas a este filme também serão desativadas.</p>
                </div>

                <form method="POST">
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Confirmar Exclusão
                        </button>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Excluir Filme</p>
        </div>
    </footer>

    <style>
        .card-custom {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</body>
</html>