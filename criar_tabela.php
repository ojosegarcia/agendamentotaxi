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

// Dropar a tabela se existir e criar novamente
$conn->query("DROP TABLE IF EXISTS taxis");

$sql = "
    CREATE TABLE taxis (
        id INT AUTO_INCREMENT PRIMARY KEY,
        local VARCHAR(255) NOT NULL,
        disponibilidade ENUM('disponível', 'indisponível') NOT NULL,
        UNIQUE INDEX idx_local (local)
    );
";

// Executar a criação da tabela
if ($conn->query($sql) === TRUE) {
    echo "Tabela 'taxis' criada com sucesso.";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
