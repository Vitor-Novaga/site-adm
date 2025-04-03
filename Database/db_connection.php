<?php
$servername = "localhost"; // Ou outro host se não for local
$username = "root"; // Seu usuário do MySQL
$password = ""; // Sua senha do MySQL (vazia por padrão no XAMPP)
$database = "devmedia_db"; // Nome do seu banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
