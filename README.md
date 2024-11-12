

```markdown
# Sistema de Listagem de Táxis 🚖

Este é um projeto simples em PHP que lista táxis cadastrados em um banco de dados MySQL e exibe os resultados em uma lista suspensa (dropdown). O usuário pode selecionar um táxi e enviar a seleção via formulário.

## 📋 Funcionalidades

- Conexão com banco de dados MySQL usando PDO.
- Consulta e exibição dos táxis cadastrados em uma lista suspensa.
- Envio da seleção para um script PHP.

## 🛠️ Tecnologias Utilizadas

- **PHP** (com PDO para conexão ao banco de dados)
- **HTML** (para exibição do formulário e da lista suspensa)
- **MySQL** (para armazenar e buscar os dados dos táxis)

## ⚙️ Como Configurar o Projeto

1. **Clonar o repositório**:
   ```bash
   git clone https://github.com/ojosegarcia/agendamentotaxi.git
   cd agendamentotaxi
   ```

2. **Configurar o banco de dados**:

   - Crie um banco de dados no MySQL (por exemplo, `agendamentotaxi`).
   - Crie uma tabela chamada `taxis`:

     ```sql
     CREATE TABLE taxis (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome_taxi VARCHAR(255) NOT NULL
     );
     ```

   - Insira alguns registros na tabela:

     ```sql
     INSERT INTO taxis (nome_taxi) VALUES ('Táxi 1'), ('Táxi 2'), ('Táxi 3');
     ```

3. **Configurar as credenciais do banco de dados no PHP**:

   - No arquivo PHP principal, ajuste as seguintes variáveis para se conectarem ao banco:

     ```php
     $host = 'localhost';     // Seu host do banco de dados
     $dbname = 'agendamentotaxi';   // Seu banco de dados
     $username = 'root';       // Seu usuário do MySQL
     $password = '';           // Sua senha do MySQL
     ```

4. **Rodar o projeto**:

   - Suba o servidor PHP localmente:

     ```bash
     php -S localhost:8000
     ```

   - Acesse o projeto pelo navegador: [http://localhost:8000](http://localhost:8000)

---


