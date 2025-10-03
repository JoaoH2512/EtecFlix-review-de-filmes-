<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EtecFlix</title>
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
                <li><a href="index.php">Início</a></li>
                <li><a href="sobre.php">Sobre</a></li>
                <li><a href="login.php" class="ativo">Login</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-box slide-up">
            <h2 class="login-title">Login EtecFlix</h2>
            
            <!-- Formulário de Login -->
            <form id="form-login">
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </div>
                
                <div class="text-center">
                    <p>Não tem conta? <a href="registro.php" class="text-primary">Cadastre-se</a></p>
                </div>
            </form>
            
            <!-- Divisor -->
            <div class="divider">
                <span>ou</span>
            </div>
            
            <!-- Login como Visitante -->
            <div class="text-center">
                <p>Quer apenas explorar?</p>
                <a href="index.php" class="btn btn-outline-secondary">Continuar como Visitante</a>
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