<?php
include("conexao.php");

$cliente = $_POST['cliente'];
$data = $_POST['data'];

// Insere o agendamento no banco de dados
$sql = "INSERT INTO agendamentos (cliente, data_agendamento) VALUES ('$cliente', '$data')";

if ($mysqli->query($sql) === TRUE) {
    echo "Novo agendamento adicionado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $mysqli->error;
}

// Redireciona de volta para o index.php
header("Location: index.php");
?>
