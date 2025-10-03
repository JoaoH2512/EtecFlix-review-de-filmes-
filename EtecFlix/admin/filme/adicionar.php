<?php
session_start();
require_once '../../config.php';

// Verificar se usuário está logado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header('Location: ../../login.php');
    exit();
}

$pdo = getDBConnection();
$mensagem = '';

// Processar adição de filme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO filmes (titulo, titulo_original, ano_lancamento, duracao, genero, diretor, elenco, sinopse, poster_url, classificacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $_POST['titulo'],
            $_POST['titulo_original'] ?: $_POST['titulo'],
            $_POST['ano_lancamento'],
            $_POST['duracao'] ?: 120,
            $_POST['genero'],
            $_POST['diretor'] ?: 'Não informado',
            $_POST['elenco'] ?: 'Não informado',
            $_POST['sinopse'],
            $_POST['poster_url'],
            $_POST['classificacao'] ?: 'L'
        ]);
        
        header('Location: index.php?sucesso=Filme adicionado com sucesso!');
        exit();
    } catch (PDOException $e) {
        $mensagem = '<div class="alert alert-danger">Erro ao adicionar filme: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme - EtecFlix Admin</title>
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
                <h2 class="admin-title">Adicionar Novo Filme</h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <?= $mensagem ?>

            <div class="card-custom p-4">
                <form method="POST" id="form-adicionar-filme">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Título do Filme *</label>
                                <input type="text" class="form-control" name="titulo" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Título Original</label>
                                <input type="text" class="form-control" name="titulo_original">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Ano de Lançamento *</label>
                                <input type="number" class="form-control" name="ano_lancamento" min="1900" max="2030" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Duração (minutos)</label>
                                <input type="number" class="form-control" name="duracao" min="1" value="120">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Classificação</label>
                                <select class="form-control" name="classificacao">
                                    <option value="L">L - Livre</option>
                                    <option value="10">10 anos</option>
                                    <option value="12" selected>12 anos</option>
                                    <option value="14">14 anos</option>
                                    <option value="16">16 anos</option>
                                    <option value="18">18 anos</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Gênero(s) *</label>
                        <input type="text" class="form-control" name="genero" placeholder="Ação, Aventura, Drama..." required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Diretor</label>
                        <input type="text" class="form-control" name="diretor" placeholder="Nome do diretor">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Elenco Principal</label>
                        <textarea class="form-control" name="elenco" rows="3" placeholder="Nome dos principais atores..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Sinopse *</label>
                        <textarea class="form-control" name="sinopse" rows="5" placeholder="Descrição do filme..." required></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">URL do Poster *</label>
                        <input type="url" class="form-control" name="poster_url" placeholder="https://exemplo.com/poster.jpg" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Adicionar Filme
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
            <p>&copy; 2025 EtecFlix - Adicionar Filme</p>
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