<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

// Verifica se a conexão foi estabelecida
if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Configuração da paginação
$limite = 5; // Número de usuários por página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $limite;

// Pesquisa
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$whereClause = "";
if (!empty($pesquisa)) {
    $whereClause = "WHERE nome LIKE '%$pesquisa%' OR email LIKE '%$pesquisa%'";
}

// Consulta para buscar os usuários com paginação
$query = "SELECT * FROM usuario $whereClause LIMIT $limite OFFSET $offset";
$result = $conn->query($query);

// Contagem total de registros para paginação
$queryTotal = "SELECT COUNT(*) as total FROM usuario $whereClause";
$totalResult = $conn->query($queryTotal);
$totalUsuarios = $totalResult->fetch_assoc()['total'];
$totalPaginas = ceil($totalUsuarios / $limite);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css"> 
</head>
<body>
    <?php
    include_once __DIR__ . '/../../components/navbar.php';
    include_once __DIR__ . '/../../components/sidebar.php';
    ?>

    <div class="content">
        <h1>Gerenciar Usuários</h1>
        <p>Aqui você pode adicionar, editar e remover usuários.</p>

        <!-- Barra de Pesquisa -->
        <form method="GET" action="usuarios.php" class="form-pesquisa">
            <input type="text" name="pesquisa" placeholder="Buscar usuário..." value="<?= htmlspecialchars($pesquisa) ?>">
            <button type="submit" class="btn btn-pesquisar">Pesquisar</button>
        </form>

        <a href="add_usuario.php" class="btn btn-adicionar">Adicionar Usuário</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['dtnascimento']) ?></td>
                    <td><?= htmlspecialchars($row['cpf']) ?></td>
                    <td><?= htmlspecialchars($row['telefone']) ?></td>
                    <td>
                        <a href="edit_usuario.php?id=<?= $row['id'] ?>" class="btn btn-editar">Editar</a>
                        <a href="delete_usuario.php?id=<?= $row['id'] ?>" class="btn btn-excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Paginação -->
        <div class="paginacao">
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="usuarios.php?pagina=<?= $i ?>&pesquisa=<?= urlencode($pesquisa) ?>" class="<?= ($pagina == $i) ? 'ativo' : '' ?>"> <?= $i ?> </a>
            <?php endfor; ?>
        </div>
    </div>

    <?php include_once __DIR__ . '/../../components/footer.php'; ?>
</body>
</html>
