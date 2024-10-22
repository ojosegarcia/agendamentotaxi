Sistema de Listagem de Táxis 🚖
Este é um projeto simples em PHP que lista táxis cadastrados em um banco de dados MySQL e exibe os resultados em uma lista suspensa (dropdown). O usuário pode selecionar um táxi e enviar a seleção via formulário.

📋 Funcionalidades
- Conexão com banco de dados MySQL usando PDO.
- Consulta e exibição dos táxis cadastrados em uma lista suspensa.
- Envio da seleção para um script PHP.
🛠️ Tecnologias Utilizadas
- PHP (com PDO para conexão ao banco de dados)
- HTML (para exibição do formulário e da lista suspensa)
- MySQL (para armazenar e buscar os dados dos táxis)

⚙️ Como Configurar o Projeto
Clonar o repositório:
bash
Copiar código
git clone [https://github.com/](https://github.com/ojosegarcia/agendamentotaxi.git)
cd agendamentotaxi
Configurar o banco de dados:

Crie um banco de dados no MySQL (por exemplo, agendamentotaxi).

Crie uma tabela chamada taxis (ajuste os nomes conforme necessário).

sql
Copiar código
CREATE TABLE taxis (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome_taxi VARCHAR(255) NOT NULL
);
Insira alguns registros na tabela:

sql
Copiar código
INSERT INTO taxis (nome_taxi) VALUES ('Táxi 1'), ('Táxi 2'), ('Táxi 3');
Configurar as credenciais do banco de dados no PHP:

No arquivo PHP principal, ajuste as seguintes variáveis para se conectarem ao banco:
php

Copiar código
$host = 'agendamentotaxi';   // Seu banco de dados
$username = 'root';     // Seu usuário do MySQL
$password = '';    // Sua senha do MySQL

Rodar o projeto:
Suba o servidor PHP localmente:
bash
Copiar código
php -S localhost:8000
Acesse o projeto pelo navegador: http://localhost:8000

