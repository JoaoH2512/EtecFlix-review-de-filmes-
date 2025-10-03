<?php
// config.php - Configurações de conexão com o banco de dados

define('DB_HOST', 'localhost');
define('DB_NAME', 'etecflix');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Função para conexão com o banco
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

// Função para verificar se usuário está logado
function isLoggedIn() {
    return isset($_SESSION['usuario_id']);
}

// Função para verificar se é admin
function isAdmin() {
    return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
}

// Função para fazer hash de senhas
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Função para verificar senha
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}
// Função para redirecionamento com mensagens
function redirect($url, $tipo = null, $mensagem = null) {
    if ($tipo && $mensagem) {
        $_SESSION[$tipo] = $mensagem;
    }
    header('Location: ' . $url);
    exit();
}

// Função para exibir mensagens flash
function getFlashMessage($tipo) {
    if (isset($_SESSION[$tipo])) {
        $mensagem = $_SESSION[$tipo];
        unset($_SESSION[$tipo]);
        return $mensagem;
    }
    return null;
}
?>