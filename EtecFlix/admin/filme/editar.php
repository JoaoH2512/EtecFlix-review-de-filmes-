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

// Processar atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE filmes SET titulo = ?, titulo_original = ?, ano_lancamento = ?, duracao = ?, genero = ?, diretor = ?, elenco = ?, sinopse = ?, poster_url = ?, classificacao = ? WHERE id = ?");
        
        $stmt->execute([
            $_POST['titulo'],
            $_POST['titulo_original'],
            $_POST['ano_lancamento'],
            $_POST['duracao'],
            $_POST['genero'],
            $_POST['diretor'],
            $_POST['elenco'],
            $_POST['sinopse'],
            $_POST['poster_url'],
            $_POST['classificacao'],
            $filme_id
        ]);
        
        header('Location: index.php?sucesso=Filme atualizado com sucesso!');
        exit();
    } catch (PDOException $e) {
        $erro = 'Erro ao atualizar filme: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme - EtecFlix Admin</title>
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
                <h2 class="admin-title">Editar Filme</h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <div class="card-custom p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Título do Filme *</label>
                                        <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Título Original</label>
                                        <input type="text" class="form-control" name="titulo_original" value="<?= htmlspecialchars($filme['titulo_original']) ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Ano de Lançamento *</label>
                                        <input type="number" class="form-control" name="ano_lancamento" value="<?= $filme['ano_lancamento'] ?>" min="1900" max="2030" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Duração (minutos)</label>
                                        <input type="number" class="form-control" name="duracao" value="<?= $filme['duracao'] ?>" min="1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Classificação</label>
                                        <select class="form-control" name="classificacao">
                                            <option value="L" <?= $filme['classificacao'] == 'L' ? 'selected' : '' ?>>L - Livre</option>
                                            <option value="10" <?= $filme['classificacao'] == '10' ? 'selected' : '' ?>>10 anos</option>
                                            <option value="12" <?= $filme['classificacao'] == '12' ? 'selected' : '' ?>>12 anos</option>
                                            <option value="14" <?= $filme['classificacao'] == '14' ? 'selected' : '' ?>>14 anos</option>
                                            <option value="16" <?= $filme['classificacao'] == '16' ? 'selected' : '' ?>>16 anos</option>
                                            <option value="18" <?= $filme['classificacao'] == '18' ? 'selected' : '' ?>>18 anos</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Gênero *</label>
                                <input type="text" class="form-control" name="genero" value="<?= htmlspecialchars($filme['genero']) ?>" required>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Diretor</label>
                                <input type="text" class="form-control" name="diretor" value="<?= htmlspecialchars($filme['diretor']) ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Elenco Principal</label>
                                <textarea class="form-control" name="elenco" rows="3"><?= htmlspecialchars($filme['elenco']) ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Sinopse *</label>
                                <textarea class="form-control" name="sinopse" rows="5" required><?= htmlspecialchars($filme['sinopse']) ?></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label">URL do Poster *</label>
                                <input type="url" class="form-control" name="poster_url" value="<?= htmlspecialchars($filme['poster_url']) ?>" required>
                            </div>
                        </div>

                        <div class="col-md-4 text-center">
                            <img src="<?= htmlspecialchars($filme['poster_url']) ?>" 
                                 alt="<?= htmlspecialchars($filme['titulo']) ?>" 
                                 class="img-fluid rounded mb-3" 
                                 style="max-height: 400px; object-fit: cover;">
                            <p class="text-muted">Preview do poster</p>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Atualizar Filme
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
            <p>&copy; 2025 EtecFlix - Editar Filme</p>
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