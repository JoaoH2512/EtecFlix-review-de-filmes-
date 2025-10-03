<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - EtecFlix</title>
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
                <li><a href="login.php">Login</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <!-- Registro Container -->
    <div class="login-container">
        <div class="login-box slide-up">
            <h2 class="login-title">Criar Conta</h2>
            
            <!-- Formulário de Registro -->
            <form id="form-registro">
                <div class="form-group">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="usuario" class="form-label">Nome de Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="seu.usuario" required>
                </div>
                
                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                </div>
                
                <div class="form-group">
                    <label for="confirmar-senha" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" id="confirmar-senha" name="confirmar_senha" placeholder="Confirme sua senha" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">Criar Conta</button>
                </div>
                
                <div class="text-center">
                    <p>Já tem conta? <a href="login.php" class="text-primary">Faça login</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 EtecFlix - Desenvolvido por João Henrique de Andrade Gimenes</p>
            <p>Projeto Acadêmico - Sistemas Web I</p>
        </div>
    </footer>

    <script>
        // Validação de senha
        document.getElementById('form-registro').addEventListener('submit', function(e) {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmar-senha').value;
            
            if (senha !== confirmarSenha) {
                e.preventDefault();
                alert('As senhas não coincidem!');
                return false;
            }
            
            if (senha.length < 6) {
                e.preventDefault();
                alert('A senha deve ter pelo menos 6 caracteres!');
                return false;
            }
            
            alert('Conta criada com sucesso! (Simulação)');
            window.location.href = 'login.php';
        });
    </script>
    <script src="script.js"></script>
</body>
</html>