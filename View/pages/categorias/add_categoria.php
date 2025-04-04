<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];


    $query = "INSERT INTO categoria (nome) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nome);

    if ($stmt->execute()) {
        header("Location: categorias.php");  
        exit();
    } else {
        echo "Erro ao adicionar categoria: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Categoria</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css"> 
</head>
<body>
    <?php
    include_once __DIR__ . '/../../components/navbar.php';
    include_once __DIR__ . '/../../components/sidebar.php';
    ?>

    <div class="content">
        <h1>Adicionar Nova Categoria</h1>
        <form method="POST" action="add_categoria.php">
            Nome da Categoria: <input type="text" name="nome" required><br>
            <button type="submit">Adicionar Categoria</button>
        </form>
    </div>

    <?php include_once __DIR__ . '/../../components/footer.php'; ?>
</body>
</html>
