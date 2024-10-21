<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agendamentotaxi";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
echo "Conectado ao Banco de Dados";

// Adicionar agendamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $data_agendamento = $_POST["data_agendamento"];

    // Preparar e executar a inserção
    $sql = "INSERT INTO agendamento (ID_Cliente, Data_Agendamento) VALUES ('$cliente', '$data_agendamento')";
    if ($conn->query($sql) === TRUE) {
        echo "Novo agendamento criado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Exibir agendamentos existentes
$sql = "SELECT * FROM agendamento";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agendamento de Táxi</title>
</head>
<body>
    <h1>Agendamento de Táxi</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Nome do Cliente: <input type="text" name="cliente"><br>
        Data do Agendamento: <input type="date" name="data_agendamento" placeholder="dd/mm/aaaa"><br>
        <input type="submit" value="Adicionar Agendamento">
    </form>

    <h2>Lista de Agendamentos</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>";
        // Saída de cada linha de dados
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID_Agendamento"]. "</td>
                    <td>" . $row["ID_Cliente"]. "</td>
                    <td>" . $row["Data_Agendamento"]. "</td>
                    <td><a href='editar.php?id=" . $row["ID_Agendamento"]. "'>Editar</a> | <a href='deletar.php?id=" . $row["ID_Agendamento"]. "'>Deletar</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum agendamento encontrado.";
    }

    // Fechar a conexão
    $conn->close();
    ?>
</body>
</html>
