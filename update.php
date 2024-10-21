<?php
// Conectar ao banco de dados
require 'config.php';

// Verificar se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];

    // Atualizar os dados no banco de dados
    $stmt = $conn->prepare("UPDATE agendamentos SET data = ?, hora = ?, local = ? WHERE id = ?");
    $stmt->bind_param("sssi", $data, $hora, $local, $id);
    $stmt->execute();

    // Redirecionar após a atualização
    header("Location: index.php");
    exit;
}
?>
