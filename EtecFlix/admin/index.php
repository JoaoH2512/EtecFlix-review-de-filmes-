<?php
session_start();
require_once '../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

$pdo = getDBConnection();

// Buscar estatísticas
$stmt_stats = $pdo->query("
    SELECT 
        (SELECT COUNT(*) FROM filmes WHERE ativo = TRUE) as total_filmes,
        (SELECT COUNT(*) FROM avaliacoes WHERE ativo = TRUE) as total_avaliacoes,
        (SELECT COUNT(*) FROM usuarios WHERE ativo = TRUE) as total_usuarios,
        (SELECT AVG(nota) FROM avaliacoes WHERE ativo = TRUE) as media_geral
");
$stats = $stmt_stats->fetch();

// Buscar últimas avaliações
$stmt_ultimas_avaliacoes = $pdo->query("
    SELECT a.*, u.usuario, f.titulo as filme_titulo
    FROM avaliacoes a
    JOIN usuarios u ON a.usuario_id = u.id
    JOIN filmes f ON a.filme_id = f.id
    WHERE a.ativo = TRUE
    ORDER BY a.data_avaliacao DESC
    LIMIT 5
");
$ultimas_avaliacoes = $stmt_ultimas_avaliacoes->fetchAll();

// Buscar filmes mais avaliados
$stmt_filmes_populares = $pdo->query("
    SELECT f.*, COUNT(a.id) as total_avaliacoes, AVG(a.nota) as media
    FROM filmes f
    LEFT JOIN avaliacoes a ON f.id = a.filme_id AND a.ativo = TRUE
    WHERE f.ativo = TRUE
    GROUP BY f.id
    ORDER BY total_avaliacoes DESC
    LIMIT 5
");
$filmes_populares = $stmt_filmes_populares->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - EtecFlix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">EtecFlix Admin</div>
        <nav>
            <ul>
                <li><a href="../index.php">Início Site</a></li>
                <li><a href="index.php" class="ativo">Painel Admin</a></li>
                <li><a href="../login.php?logout=true">Sair</a></li>
            </ul>
        </nav>
    </header>

    <!-- Admin Container -->
    <div class="admin-container">
        <div class="container">
            <!-- Mensagens -->
            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
            <?php endif; ?>
            
            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
            <?php endif; ?>

            <div class="admin-header">
                <h2 class="admin-title">Painel Administrativo</h2>
                <div class="admin-actions">
                    <a href="filmes/adicionar.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Adicionar Filme
                    </a>
                </div>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="card-custom text-center p-4">
                        <i class="fas fa-film fa-3x text-primary mb-3"></i>
                        <h3><?= $stats['total_filmes'] ?></h3>
                        <p class="text-muted">Total de Filmes</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-custom text-center p-4">
                        <i class="fas fa-star fa-3x text-warning mb-3"></i>
                        <h3><?= $stats['total_avaliacoes'] ?></h3>
                        <p class="text-muted">Total de Avaliações</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-custom text-center p-4">
                        <i class="fas fa-users fa-3x text-success mb-3"></i>
                        <h3><?= $stats['total_usuarios'] ?></h3>
                        <p class="text-muted">Total de Usuários</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-custom text-center p-4">
                        <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                        <h3><?= number_format($stats['media_geral'], 1) ?></h3>
                        <p class="text-muted">Média Geral</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Gestão Rápida -->
                <div class="col-md-6">
                    <div class="card-custom p-4">
                        <h4 class="mb-4">Ações Rápidas</h4>
                        <div class="d-grid gap-2">
                            <a href="filmes/adicionar.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Adicionar Novo Filme
                            </a>
                            <a href="filmes/index.php" class="btn btn-outline-secondary">
                                <i class="fas fa-edit"></i> Gerenciar Filmes
                            </a>
                            <a href="avaliacoes/index.php" class="btn btn-outline-secondary">
                                <i class="fas fa-star"></i> Gerenciar Avaliações
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Últimas Avaliações -->
                <div class="col-md-6">
                    <div class="card-custom p-4">
                        <h4 class="mb-4">Últimas Avaliações</h4>
                        <?php if (empty($ultimas_avaliacoes)): ?>
                            <p class="text-muted">Nenhuma avaliação recente.</p>
                        <?php else: ?>
                            <?php foreach ($ultimas_avaliacoes as $avaliacao): ?>
                                <div class="avaliacao-rapida mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong><?= htmlspecialchars($avaliacao['usuario']) ?></strong>
                                            <small class="text-muted"> em <?= htmlspecialchars($avaliacao['filme_titulo']) ?></small>
                                        </div>
                                        <div class="estrelas pequenas">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= $avaliacao['nota'] ? '' : '-half-alt' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <?php if (!empty($avaliacao['comentario'])): ?>
                                        <p class="mt-2 mb-0 small">"<?= htmlspecialchars(substr($avaliacao['comentario'], 0, 100)) ?><?= strlen($avaliacao['comentario']) > 100 ? '...' : '' ?>"</p>
                                    <?php endif; ?>
                                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($avaliacao['data_avaliacao'])) ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Filmes Mais Avaliados -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card-custom p-4">
                        <h4 class="mb-4">Filmes Mais Avaliados</h4>
                        <div class="row">
                            <?php foreach ($filmes_populares as $filme): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= htmlspecialchars($filme['poster_url']) ?>" 
                                             alt="<?= htmlspecialchars($filme['titulo']) ?>" 
                                             class="rounded me-3" 
                                             style="width: 60px; height: 90px; object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?= htmlspecialchars($filme['titulo']) ?></h6>
                                            <div class="d-flex align-items-center">
                                                <div class="estrelas pequenas me-2">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star<?= $i <= $filme['media'] ? '' : '-half-alt' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <small class="text-muted">(<?= $filme['total_avaliacoes'] ?> avaliações)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Painel Administrativo</p>
            <p>Usuário: <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin') ?></p>
        </div>
    </footer>

    <style>
        .card-custom {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .estrelas.pequenas {
            font-size: 0.8rem;
        }
        .avaliacao-rapida {
            background: #f8f9fa;
            border-color: #dee2e6 !important;
        }
    </style>
</body>
</html>