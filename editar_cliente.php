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

// Editar cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST["id_cliente"];
    $nome = $_POST["nome"];
    
    // Preparar e executar a atualização
    $sql = "UPDATE cliente SET Nome='$nome' WHERE ID_Cliente='$id_cliente'";
    if ($conn->query($sql) === TRUE) {
        echo "Cliente atualizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Obter dados do cliente a ser editado
$id_cliente = isset($_GET["id"]) ? $_GET["id"] : 0;
$sql = "SELECT * FROM cliente WHERE ID_Cliente='$id_cliente'";
$result = $conn->query($sql);
$cliente = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id_cliente" value="<?php echo $cliente['ID_Cliente']; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $cliente['Nome']; ?>" required><br>
        <input type="submit" value="Salvar">
    </form>
    <br>
    <a href="index.php">Voltar para o Agendamento</a>
</body>
</html>
