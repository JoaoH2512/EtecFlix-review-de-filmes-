<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EtecFlix - Avaliação de Filmes</title>
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
                <li><a href="index.php" class="ativo">Início</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Bem-vindo ao EtecFlix</h1>
                <p class="lead">Descubra, avalie e compartilhe suas opiniões sobre os melhores filmes</p>
                <div class="hero-buttons">
                    <a href="#filmes" class="btn btn-primary">Explorar Filmes</a>
                    <a href="login.php" class="btn btn-outline">Fazer Login</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Catálogo de Filmes -->
    <section id="filmes" class="filmes-section">
        <div class="container">
            <h2>Filmes em Destaque</h2>
            <div class="filmes-grid">
                <!-- Filme 1 -->
                <div class="filme-card" data-filme-id="1">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/007bff/ffffff?text=Homem-Aranha" alt="Homem-Aranha">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">Homem-Aranha: Sem Volta para Casa</h3>
                        <p class="filme-ano">2021 • Ação, Aventura</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-num">4.5</span>
                        </div>
                    </div>
                </div>

                <!-- Filme 2 -->
                <div class="filme-card" data-filme-id="2">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/dc3545/ffffff?text=Avatar" alt="Avatar 2">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">Avatar: O Caminho da Água</h3>
                        <p class="filme-ano">2022 • Ficção Científica</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="rating-num">4.0</span>
                        </div>
                    </div>
                </div>

                <!-- Filme 3 -->
                <div class="filme-card" data-filme-id="3">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/28a745/ffffff?text=Top+Gun" alt="Top Gun">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">Top Gun: Maverick</h3>
                        <p class="filme-ano">2022 • Ação, Drama</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="rating-num">5.0</span>
                        </div>
                    </div>
                </div>

                <!-- Filme 4 -->
                <div class="filme-card" data-filme-id="4">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/ffc107/000000?text=Batman" alt="Batman">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">The Batman</h3>
                        <p class="filme-ano">2022 • Ação, Crime</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="rating-num">4.0</span>
                        </div>
                    </div>
                </div>

                <!-- Filme 5 -->
                <div class="filme-card" data-filme-id="5">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/6f42c1/ffffff?text=Duna" alt="Duna">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">Duna</h3>
                        <p class="filme-ano">2021 • Ficção Científica</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-num">4.5</span>
                        </div>
                    </div>
                </div>

                <!-- Filme 6 -->
                <div class="filme-card" data-filme-id="6">
                    <div class="filme-poster">
                        <img src="https://via.placeholder.com/300x450/fd7e14/ffffff?text=Jurassic" alt="Jurassic World">
                        <div class="filme-overlay">
                            <button class="btn-avaliar">Avaliar</button>
                        </div>
                    </div>
                    <div class="filme-info">
                        <h3 class="filme-titulo">Jurassic World: Domínio</h3>
                        <p class="filme-ano">2022 • Ação, Aventura</p>
                        <div class="rating">
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="rating-num">3.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Avaliação -->
    <div id="modal-avaliacao" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">Avaliar Filme</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form-avaliacao">
                    <input type="hidden" id="filme-id" name="filme_id">
                    <div class="form-group">
                        <label class="form-label">Sua Avaliação</label>
                        <div class="rating-input">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comentario" class="form-label">Comentário</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="4" placeholder="Escreva sua opinião sobre o filme..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary modal-cancel">Cancelar</button>
                <button class="btn btn-primary" id="btn-enviar-avaliacao">Enviar Avaliação</button>
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