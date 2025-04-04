<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "DELETE FROM artigos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        header("Location: artigos.php");
        exit();
    } else {
        echo "Erro ao excluir artigo: " . $conn->error;
    }
} else {
    echo "ID do artigo não especificado.";
}
?>
