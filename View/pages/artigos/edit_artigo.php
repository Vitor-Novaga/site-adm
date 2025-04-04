<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM artigos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $artigo = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    
    $query = "UPDATE artigos SET nome = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nome, $id); 

    if ($stmt->execute()) {
        header("Location: artigos.php");
        exit();
    } else {
        echo "Erro ao editar artigo: " . $conn->error;
    }
}
?>

<form method="POST" action="edit_artigo.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($artigo['id']) ?>">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($artigo['nome']) ?>" required><br>
    <button type="submit">Salvar Alterações</button>
</form>
