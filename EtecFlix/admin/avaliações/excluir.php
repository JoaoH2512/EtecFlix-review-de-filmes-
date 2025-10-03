<?php
session_start();
require_once '../../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: index.php?erro=ID da avaliação não especificado');
    exit();
}

$pdo = getDBConnection();
$avaliacao_id = $_GET['id'];

// Buscar informações da avaliação
$stmt = $pdo->prepare("
    SELECT a.*, u.usuario, u.nome as usuario_nome, f.titulo as filme_titulo, f.poster_url
    FROM avaliacoes a
    JOIN usuarios u ON a.usuario_id = u.id
    JOIN filmes f ON a.filme_id = f.id
    WHERE a.id = ? AND a.ativo = TRUE
");
$stmt->execute([$avaliacao_id]);
$avaliacao = $stmt->fetch();

if (!$avaliacao) {
    header('Location: index.php?erro=Avaliação não encontrada');
    exit();
}

// Processar exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE avaliacoes SET ativo = FALSE WHERE id = ?");
        $stmt->execute([$avaliacao_id]);
        
        header('Location: index.php?sucesso=Avaliação excluída com sucesso!');
        exit();
    } catch (PDOException $e) {
        $erro = 'Erro ao excluir avaliação: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Avaliação - EtecFlix Admin</title>
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
                <h2 class="admin-title">Excluir Avaliação</h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <div class="card-custom p-4">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="<?= htmlspecialchars($avaliacao['poster_url']) ?>" 
                             alt="<?= htmlspecialchars($avaliacao['filme_titulo']) ?>" 
                             class="rounded mb-3" 
                             style="width: 150px; height: 225px; object-fit: cover;">
                        <h5><?= htmlspecialchars($avaliacao['filme_titulo']) ?></h5>
                    </div>
                    <div class="col-md-9">
                        <div class="mb-3">
                            <strong>Usuário:</strong> 
                            <?= htmlspecialchars($avaliacao['usuario_nome']) ?> (<?= htmlspecialchars($avaliacao['usuario']) ?>)
                        </div>
                        <div class="mb-3">
                            <strong>Avaliação:</strong>
                            <div class="estrelas">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?= $i <= $avaliacao['nota'] ? '' : '-half-alt' ?>"></i>
                                <?php endfor; ?>
                                <span class="ms-2"><?= number_format($avaliacao['nota'], 1) ?> / 5.0</span>
                            </div>
                        </div>
                        <?php if (!empty($avaliacao['comentario'])): ?>
                            <div class="mb-3">
                                <strong>Comentário:</strong>
                                <div class="border p-3 rounded bg-light">
                                    <?= nl2br(htmlspecialchars($avaliacao['comentario'])) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($avaliacao['data_avaliacao'])) ?>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning mt-4">
                    <h5><i class="fas fa-exclamation-triangle"></i> Atenção!</h5>
                    <p class="mb-0">Você está prestes a excluir a avaliação de <strong><?= htmlspecialchars($avaliacao['usuario']) ?></strong> para o filme "<strong><?= htmlspecialchars($avaliacao['filme_titulo']) ?></strong>". Esta ação não pode ser desfeita.</p>
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
            <p>&copy; 2025 EtecFlix - Excluir Avaliação</p>
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