<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $query = "SELECT * FROM categoria WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $categoria = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];


    $query = "UPDATE categoria SET nome = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $nome, $id);

    if ($stmt->execute()) {
        header("Location: categorias.php");  
        exit();
    } else {
        echo "Erro ao editar categoria: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css">
</head>
<body>
    <?php
    include_once __DIR__ . '/../../components/navbar.php';
    include_once __DIR__ . '/../../components/sidebar.php';
    ?>

    <div class="content">
        <h1>Editar Categoria</h1>
        <form method="POST" action="edit_categoria.php">
            <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">
            Nome da Categoria: <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required><br>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>

    <?php include_once __DIR__ . '/../../components/footer.php'; ?>
</body>
</html>
