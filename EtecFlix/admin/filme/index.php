<?php
session_start();
require_once '../../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

$pdo = getDBConnection();

// Buscar filmes
$stmt_filmes = $pdo->query("
    SELECT f.*, 
           COUNT(a.id) as total_avaliacoes,
           COALESCE(AVG(a.nota), 0) as media_avaliacao
    FROM filmes f 
    LEFT JOIN avaliacoes a ON f.id = a.filme_id AND a.ativo = TRUE
    WHERE f.ativo = TRUE
    GROUP BY f.id 
    ORDER BY f.data_adicionado DESC
");
$filmes = $stmt_filmes->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Filmes - EtecFlix Admin</title>
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
                <h2 class="admin-title">Gerenciar Filmes</h2>
                <div class="admin-actions">
                    <a href="adicionar.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Adicionar Filme
                    </a>
                    <a href="../index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar ao Painel
                    </a>
                </div>
            </div>

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
            <?php endif; ?>

            <?php if (empty($filmes)): ?>
                <div class="card-custom p-5 text-center">
                    <i class="fas fa-film fa-4x text-muted mb-3"></i>
                    <h4>Nenhum filme cadastrado</h4>
                    <p class="text-muted">Comece adicionando seu primeiro filme ao catálogo.</p>
                    <a href="adicionar.php" class="btn btn-primary">Adicionar Primeiro Filme</a>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Título</th>
                                <th>Ano</th>
                                <th>Gênero</th>
                                <th>Avaliações</th>
                                <th>Média</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filmes as $filme): ?>
                                <tr>
                                    <td>
                                        <img src="<?= htmlspecialchars($filme['poster_url']) ?>" 
                                             alt="<?= htmlspecialchars($filme['titulo']) ?>" 
                                             style="width: 60px; height: 90px; object-fit: cover; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <strong><?= htmlspecialchars($filme['titulo']) ?></strong>
                                        <?php if ($filme['titulo_original'] && $filme['titulo_original'] !== $filme['titulo']): ?>
                                            <br><small class="text-muted"><?= htmlspecialchars($filme['titulo_original']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $filme['ano_lancamento'] ?></td>
                                    <td><?= htmlspecialchars($filme['genero']) ?></td>
                                    <td><?= $filme['total_avaliacoes'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="estrelas pequenas me-2">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?= $i <= $filme['media_avaliacao'] ? '' : '-half-alt' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <span><?= number_format($filme['media_avaliacao'], 1) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="editar.php?id=<?= $filme['id'] ?>" class="btn btn-sm btn-success" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="excluir.php?id=<?= $filme['id'] ?>" class="btn btn-sm btn-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este filme?')">
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
            <p>&copy; 2025 EtecFlix - Gerenciar Filmes</p>
            <p>Total: <?= count($filmes) ?> filmes</p>
        </div>
    </footer>

    <style>
        .estrelas.pequenas {
            font-size: 0.8rem;
        }
        .card-custom {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</body>
</html>