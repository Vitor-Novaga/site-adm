<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';


if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}


$query = "SELECT * FROM categoria";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css"> 
</head>
<body>
    <?php
    include_once __DIR__ . '/../../components/navbar.php'; 
    include_once __DIR__ . '/../../components/sidebar.php'; 
    ?>

    <div class="content">
        <h1>Gerenciar Categorias</h1>
        <p>Aqui você pode adicionar, editar e remover categorias.</p>
        
        <a href="add_categoria.php" class="btn btn-adicionar">Adicionar Categoria</a>
        
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td>

                        <a href="edit_categoria.php?id=<?= $row['id'] ?>" class="btn btn-editar">Editar</a>

                        <a href="delete_categoria.php?id=<?= $row['id'] ?>" class="btn btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php include_once __DIR__ . '/../../components/footer.php';  ?>
</body>
</html>
