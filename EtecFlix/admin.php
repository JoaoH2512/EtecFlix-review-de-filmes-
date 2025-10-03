<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - EtecFlix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">EtecFlix Admin</div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="admin.php" class="ativo">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- Admin Container -->
    <div class="admin-container">
        <div class="container">
            <div class="admin-header">
                <h2 class="admin-title">Painel Administrativo</h2>
                <button class="btn btn-primary" id="btn-adicionar-filme">
                    <i class="fas fa-plus"></i> Adicionar Filme
                </button>
            </div>

            <!-- Gestão de Filmes -->
            <div class="table-container">
                <h3 class="p-3 border-bottom">Gestão de Filmes</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Poster</th>
                            <th>Título</th>
                            <th>Ano</th>
                            <th>Gênero</th>
                            <th>Avaliação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Gestão de Avaliações -->
            <div class="table-container">
                <h3 class="p-3 border-bottom">Gestão de Avaliações</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Filme</th>
                            <th>Avaliação</th>
                            <th>Comentário</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Filme -->
    <div id="modal-adicionar-filme" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Adicionar Novo Filme</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form-adicionar-filme">
                    <div class="form-group">
                        <label class="form-label">Título do Filme</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ano de Lançamento</label>
                        <input type="number" class="form-control" name="ano" min="1900" max="2030" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gênero</label>
                        <input type="text" class="form-control" name="genero" placeholder="Ação, Aventura, Drama..." required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">URL do Poster</label>
                        <input type="url" class="form-control" name="poster" placeholder="https://...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sinopse</label>
                        <textarea class="form-control" name="sinopse" rows="4" placeholder="Descrição do filme..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary modal-cancel">Cancelar</button>
                <button class="btn btn-primary">Salvar Filme</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Desenvolvido por João Henrique de Andrade Gimenes</p>
            <p>Projeto Acadêmico - Sistemas Web I</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>