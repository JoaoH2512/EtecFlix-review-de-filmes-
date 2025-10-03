<?php
session_start();
require_once '../../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

$pdo = getDBConnection();

// Buscar avaliações
$stmt_avaliacoes = $pdo->query("
    SELECT a.*, u.usuario, u.nome as usuario_nome, f.titulo as filme_titulo, f.poster_url
    FROM avaliacoes a
    JOIN usuarios u ON a.usuario_id = u.id
    JOIN filmes f ON a.filme_id = f.id
    WHERE a.ativo = TRUE
    ORDER BY a.data_avaliacao DESC
");
$avaliacoes = $stmt_avaliacoes->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Avaliações - EtecFlix Admin</title>
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
                <h2 class="admin-title">Gerenciar Avaliações</h2>
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar ao Painel
                </a>
            </div>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
            <?php endif; ?>

            <?php if (empty($avaliacoes)): ?>
                <div class="card-custom p-5 text-center">
                    <i class="fas fa-star fa-4x text-muted mb-3"></i>
                    <h4>Nenhuma avaliação encontrada</h4>
                    <p class="text-muted">Os usuários ainda não fizeram avaliações.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Filme</th>
                                <th>Avaliação</th>
                                <th>Comentário</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($avaliacoes as $avaliacao): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($avaliacao['usuario']) ?></strong>
                                        <br><small class="text-muted"><?= htmlspecialchars($avaliacao['usuario_nome']) ?></small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= htmlspecialchars($avaliacao['poster_url']) ?>" 
                                                 alt="<?= htmlspecialchars($avaliacao['filme_titulo']) ?>" 
                                                 style="width: 40px; height: 60px; object-fit: cover; border-radius: 3px; margin-right: 10px;">
                                            <span><?= htmlspecialchars($avaliacao['filme_titulo']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="estrelas pequenas me-2">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $avaliacao['nota'] ? '' : '-half-alt' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span><?= number_format($avaliacao['nota'], 1) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($avaliacao['comentario'])): ?>
                                            <div class="comentario-truncado" title="<?= htmlspecialchars($avaliacao['comentario']) ?>">
                                                <?= htmlspecialchars(substr($avaliacao['comentario'], 0, 100)) ?>
                                                <?= strlen($avaliacao['comentario']) > 100 ? '...' : '' ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">Sem comentário</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($avaliacao['data_avaliacao'])) ?>
                                        <br><small class="text-muted"><?= date('H:i', strtotime($avaliacao['data_avaliacao'])) ?></small>
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="excluir.php?id=<?= $avaliacao['id'] ?>" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta avaliação?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Gerenciar Avaliações</p>
            <p>Total: <?= count($avaliacoes) ?> avaliações</p>
        </div>
    </footer>

    <style>
        .estrelas.pequenas {
            font-size: 0.8rem;
        }
        .comentario-truncado {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .card-custom {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</body>
</html>