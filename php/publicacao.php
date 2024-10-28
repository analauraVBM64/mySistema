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
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$data = date("Y-m-d H:i:s"); // Data atual

// Validar campos
if (empty($titulo) || empty($conteudo)) {
    die("Título e conteúdo são obrigatórios.");
}

// Inserir post no banco de dados (usando prepared statement para evitar SQL Injection)
$sql = "INSERT INTO posts (titulo, conteudo, data_criacao) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $titulo, $conteudo, $data);

if ($stmt->execute()) {
    echo "Post criado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
