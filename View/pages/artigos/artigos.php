<?php
require_once __DIR__ . '/../../../config.php'; // Ajustando caminho do config
require_once __DIR__ . '/../../../Database/db_connection.php'; // Conexão com o banco de dados

// Verifica se a conexão foi estabelecida
if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Consulta para buscar os artigos
$query = "SELECT * FROM artigos";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Artigos</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css"> <!-- Caminho absoluto para o CSS principal -->
    <link rel="stylesheet" href="/siteadm/View/assets/css/components/sidebar.css"> <!-- CSS da sidebar -->
    <link rel="stylesheet" href="/siteadm/View/assets/css/components/navbar.css"> <!-- CSS da navbar -->
</head>
<body>
    <?php
    include_once __DIR__ . '/../../components/navbar.php'; // Ajustando caminho da navbar
    include_once __DIR__ . '/../../components/sidebar.php'; // Ajustando caminho da sidebar
    ?>

    <div class="content">
        <h1>Gerenciar Artigos</h1>
        <p>Aqui você pode adicionar, editar e remover artigos.</p>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php include_once __DIR__ . '/../../components/footer.php'; // Ajustando caminho do footer ?>
</body>
</html>
