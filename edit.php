<?php
// Conectar ao banco de dados
require 'config.php'; // Inclua o arquivo de configuração do banco de dados

// Verificar se o ID do agendamento foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar o agendamento no banco de dados
    $stmt = $conn->prepare("SELECT * FROM agendamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o agendamento foi encontrado
    if ($result->num_rows == 1) {
        $agendamento = $result->fetch_assoc();
    } else {
        // Caso não encontre o agendamento, redirecionar ou mostrar mensagem
        echo "Agendamento não encontrado.";
        exit;
    }
} else {
    echo "ID do agendamento não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
</head>
<body>
    <h1>Editar Agendamento</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">
        <label for="data">Data:</label>
        <input type="date" name="data" value="<?php echo $agendamento['data']; ?>" required>
        <br>
        <label for="hora">Hora:</label>
        <input type="time" name="hora" value="<?php echo $agendamento['hora']; ?>" required>
        <br>
        <label for="local">Local:</label>
        <input type="text" name="local" value="<?php echo $agendamento['local']; ?>" required>
        <br>
        <button type="submit">Salvar</button>
    </form>
    
    <form action="delete.php" method="POST" style="margin-top: 20px;">
        <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">
        <button type="submit" onclick="return confirm('Tem certeza que deseja deletar este agendamento?');">Deletar Agendamento</button>
    </form>
    
    <a href="index.php">Voltar</a>
</body>
</html>
