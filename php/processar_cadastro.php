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

// Obter dados do formulário
$name = $_POST['name'];
$nome = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['password'];
$confirmSenha = $_POST['confirmPassword'];

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido.");
}

// Verificar se as senhas coincidem
if ($senha !== $confirmSenha) {
    die("As senhas não coincidem.");
}

// Hash da senha
$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

// Inserir usuário no banco de dados (usando prepared statement para evitar SQL Injection)
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senhaHash);

if ($stmt->execute()) {
    echo "Conta criada com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
