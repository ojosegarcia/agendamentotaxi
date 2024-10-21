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

// Obter o ID da classe
$classe_id = isset($_GET['classe_id']) ? intval($_GET['classe_id']) : 0;

// Verifique se o ID da classe é válido
if ($classe_id > 0) {
    // Obter a lista de táxis da classe selecionada
    $sqlTaxis = "SELECT ID_Taxi, Modelo FROM taxi WHERE ID_Classe = $classe_id AND disponibilidade = 'disponível'";
    $resultTaxis = $conn->query($sqlTaxis);

    if ($resultTaxis && $resultTaxis->num_rows > 0) {
        while ($rowTaxi = $resultTaxis->fetch_assoc()) {
            echo "<option value='" . $rowTaxi["ID_Taxi"] . "'>" . $rowTaxi["Modelo"] . "</option>";
        }
    } else {
        echo "<option value=''>Nenhum táxi disponível</option>";
    }
} else {
    echo "<option value=''>Classe inválida</option>";
}

// Fechar a conexão
$conn->close();
?>
