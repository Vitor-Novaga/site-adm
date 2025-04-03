<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dtnascimento = $_POST['dtnascimento'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    $query = "UPDATE usuario SET nome = ?, email = ?, dtnascimento = ?, cpf = ?, telefone = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $nome, $email, $dtnascimento, $cpf, $telefone, $id);

    if ($stmt->execute()) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "Erro ao editar usuário: " . $conn->error;
    }
}
?>

<form method="POST" action="edit_usuario.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br>
    Data de Nascimento: <input type="date" name="dtnascimento" value="<?= htmlspecialchars($usuario['dtnascimento']) ?>" required><br>
    CPF: <input type="text" name="cpf" value="<?= htmlspecialchars($usuario['cpf']) ?>" required><br>
    Telefone: <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>" required><br>
    <button type="submit">Salvar Alterações</button>
</form>
