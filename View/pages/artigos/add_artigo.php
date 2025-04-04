<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    // Adicione outros campos que são necessários
    
    $query = "INSERT INTO artigos (nome) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nome); 

    if ($stmt->execute()) {
        header("Location: artigos.php");
        exit();
    } else {
        echo "Erro ao adicionar artigo: " . $conn->error;
    }
}
?>

<form method="POST" action="add_artigo.php">
    Nome: <input type="text" name="nome" required><br>
    <button type="submit">Adicionar</button>
</form>
