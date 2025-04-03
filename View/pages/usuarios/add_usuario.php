<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../Database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dtnascimento = $_POST['dtnascimento'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    $query = "INSERT INTO usuario (nome, email, dtnascimento, cpf, telefone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $nome, $email, $dtnascimento, $cpf, $telefone);

    if ($stmt->execute()) {
        header("Location: usuarios.php");
        exit();
    } else {
        echo "Erro ao adicionar usuário: " . $conn->error;
    }
}
?>

<form method="POST" action="add_usuario.php">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="email" required><br>
    Data de Nascimento: <input type="date" name="dtnascimento" required><br>
    CPF: <input type="text" name="cpf" required><br>
    Telefone: <input type="text" name="telefone" required><br>
    <button type="submit">Adicionar</button>
</form>
