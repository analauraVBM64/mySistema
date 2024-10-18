<?php
$servername = "localhost";
$username = "root"; 
$password = "aluno01"; 
$dbname = "agro";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Iniciar sessão para manter o login
session_start();

// Obter dados do formulário
$email = $_POST['email'];
$senha = $_POST['password'];

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido.");
}

// Buscar o usuário no banco de dados (usando prepared statement para evitar SQL Injection)
$sql = "SELECT senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

// Verificar se o usuário existe
if ($stmt->num_rows === 0) {
    echo "Usuário não encontrado.";
    $stmt->close();
    $conn->close();
    exit();
}

// Obter o hash da senha do banco de dados
$stmt->bind_result($senhaHash);
$stmt->fetch();

// Verificar a senha
if (password_verify($senha, $senhaHash)) {
    echo "Login bem-sucedido!";
    // Iniciar a sessão do usuário
    $_SESSION['usuario'] = $email;
    // Redirecionar para uma página protegida
    header("Location: pagina_protegida.php");
    exit();
} else {
    echo "Senha incorreta.";
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
