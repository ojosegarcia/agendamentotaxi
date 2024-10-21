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

// Inicializando variáveis
$clienteSelecionado = isset($_POST["cliente"]) ? $_POST["cliente"] : "";
$dataAgendamento = isset($_POST["data_agendamento"]) ? $_POST["data_agendamento"] : "";
$classeSelecionada = isset($_POST["classe"]) ? $_POST["classe"] : "";
$taxiSelecionado = isset($_POST["taxi"]) ? $_POST["taxi"] : ""; // Captura o ID do táxi, se disponível

// Adicionar agendamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se os campos estão preenchidos
    if (!empty($clienteSelecionado) && !empty($dataAgendamento) && !empty($taxiSelecionado)) {
        // Preparar e executar a inserção
        $sql = "INSERT INTO agendamento (ID_Cliente, Data_Agendamento, ID_Taxi) VALUES ('$clienteSelecionado', '$dataAgendamento', '$taxiSelecionado')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Novo agendamento criado com sucesso!');</script>";
            // Reiniciar as variáveis
            $clienteSelecionado = $dataAgendamento = $classeSelecionada = $taxiSelecionado = ""; // Limpa as variáveis após o sucesso
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Obter a lista de clientes para o drop-down
$sqlClientes = "SELECT ID_Cliente, Nome FROM cliente";
$resultClientes = $conn->query($sqlClientes);

// Obter a lista de classes para o drop-down
$sqlClasses = "SELECT ID_Classe, Descricao FROM classe";
$resultClasses = $conn->query($sqlClasses);

// Obter a lista de táxis para o drop-down (com base na classe selecionada)
$taxisDisponiveis = [];
if ($classeSelecionada) {
    $sqlTaxis = "SELECT ID_Taxi, Modelo FROM taxi WHERE ID_Classe = $classeSelecionada";
    $resultTaxis = $conn->query($sqlTaxis);
    
    if ($resultTaxis && $resultTaxis->num_rows > 0) {
        while($rowTaxi = $resultTaxis->fetch_assoc()) {
            $taxisDisponiveis[] = $rowTaxi;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Táxi</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Adicione esta linha -->

<body>
 
    <!-- O restante do seu código HTML -->
</body>
    <title>Agendamento de Táxi</title>
    <script>
        function validateForm() {
            var cliente = document.forms["agendamentoForm"]["cliente"].value;
            var data = document.forms["agendamentoForm"]["data_agendamento"].value;
            var taxi = document.forms["agendamentoForm"]["taxi"].value;

            if (cliente == "" || data == "" || taxi == "") {
                alert("Por favor, preencha todos os campos obrigatórios.");
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }
    </script>
</head>
<body>
    <h1>Agendamento de Táxi</h1>

    <form name="agendamentoForm" method="post" action="" onsubmit="return validateForm()">
        Nome do Cliente: 
        <select name="cliente">
            <?php
            if ($resultClientes->num_rows > 0) {
                while($rowCliente = $resultClientes->fetch_assoc()) {
                    // Manter a seleção do cliente após o envio do formulário
                    $selected = ($rowCliente["ID_Cliente"] == $clienteSelecionado) ? "selected" : "";
                    echo "<option value='" . $rowCliente["ID_Cliente"] . "' $selected>" . $rowCliente["Nome"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum cliente encontrado</option>";
            }
            ?>
        </select><br>
        
        Data do Agendamento: <input type="date" name="data_agendamento" value="<?php echo $dataAgendamento; ?>"><br>
        
        Classe: 
        <select name="classe" onchange="this.form.submit()">
            <option value="">Selecione uma Classe</option>
            <?php
            if ($resultClasses->num_rows > 0) {
                while ($rowClasse = $resultClasses->fetch_assoc()) {
                    // Manter a seleção da classe após o envio do formulário
                    $selected = ($rowClasse["ID_Classe"] == $classeSelecionada) ? "selected" : "";
                    echo "<option value='" . $rowClasse["ID_Classe"] . "' $selected>" . $rowClasse["Descricao"] . "</option>";
                }
            }
            ?>
        </select><br>

        Táxi: 
        <select name="taxi">
            <option value="">Selecione um Táxi</option>
            <?php
            if (!empty($taxisDisponiveis)) {
                foreach ($taxisDisponiveis as $rowTaxi) {
                    // Manter a seleção do táxi após o envio do formulário
                    $selected = ($rowTaxi["ID_Taxi"] == $taxiSelecionado) ? "selected" : "";
                    echo "<option value='" . $rowTaxi["ID_Taxi"] . "' $selected>" . $rowTaxi["Modelo"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum táxi disponível</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Adicionar Agendamento">
    </form>

    <h2>Lista de Agendamentos</h2>
    <?php
    // Exibir agendamentos existentes
    $sql = "SELECT agendamento.ID_Agendamento, cliente.Nome AS Cliente, taxi.Modelo AS Taxi, taxi.Placa, taxista.Nome AS Taxista, agendamento.Data_Agendamento 
            FROM agendamento 
            JOIN cliente ON agendamento.ID_Cliente = cliente.ID_Cliente 
            JOIN taxi ON agendamento.ID_Taxi = taxi.ID_Taxi 
            JOIN taxista ON taxi.ID_Taxista = taxista.ID_Taxista"; // Ajustar a consulta para incluir os dados do táxi e do taxista
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Taxi</th>
                    <th>Placa</th>
                    <th>Taxista</th>
                    <th>Data</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["ID_Agendamento"]. "</td>
                    <td>" . $row["Cliente"]. "</td>
                    <td>" . $row["Taxi"]. "</td>
                    <td>" . $row["Placa"]. "</td>
                    <td>" . $row["Taxista"]. "</td>
                    <td>" . $row["Data_Agendamento"]. "</td>
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
