<?php
include("conexao.php");

$id = $_GET['id'];

// Deleta o agendamento baseado no ID
$sql = "DELETE FROM agendamentos WHERE id=$id";

if ($mysqli->query($sql) === TRUE) {
    echo "Agendamento excluído com sucesso!";
} else {
    echo "Erro ao excluir: " . $mysqli->error;
}

// Redireciona de volta para o index.php
header("Location: index.php");
?>
