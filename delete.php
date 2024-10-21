<?php
// Conectar ao banco de dados
require 'config.php';

// Verificar se o ID do agendamento foi passado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Deletar o agendamento no banco de dados
    $stmt = $conn->prepare("DELETE FROM agendamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirecionar após a exclusão
    header("Location: index.php");
    exit;
}
?>
