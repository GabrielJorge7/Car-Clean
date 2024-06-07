<!DOCTYPE html>
<html>
<head>
<style>
    body {
        background: linear-gradient(to bottom, #3498db, #ffffff); 
        color: #000; 
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1 {
        background-color: #3498db; 
        color: #fff; 
        text-align: center;
        padding: 20px;
    }

    form {
        width: 400px;
        margin: 0 auto;
        padding: 40px;
        border-radius: 10px;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="time"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        outline: none;
        border: 0;
        background: transparent;
        border-bottom: 1px solid #fff;
        color: #fff;
        font-size: 16px;
        margin-bottom: 30px;
    }

    input[type="submit"] {
        background-color: #03e9f4; 
        color: #fff; 
        padding: 12px 20px;
        border: none;
        cursor: pointer;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 4px;
        font-weight: 700;
        margin-top: 20px;
        transition: 0.5s;
        overflow: hidden;
    }

    input[type="submit"]:hover {
        background: #172031; 
        border-radius: 5px;
    }
    
    select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: none;
        background: transparent;
        border-bottom: 1px solid #fff; 
        color: #fff; 
    }

    
    select option {
        background-color: #3498db; 
        color: #fff; 
    }

   
</style>

    <title>Agendamento de Serviço</title>
</head>
<body>
    <h1>Agendamento de Lava Jato</h1>
    <form method="post" action="cadastroag.php">
        <label>Carro:</label>
        <input type="text" name="carro" required><br><br>
        <label>Horário:</label>
        <input type="time" name="horario" required><br><br>
        <label>Dia:</label>
        <input type="date" name="dia" required><br><br>
        <label>Serviço:</label>
<select name="servico" required>
    <option value="lavagem-simples">Lavagem Simples</option>
    <option value="lavagem-detalhada">Lavagem Detalhada</option>
    <option value="lavagem-completa">Lavagem Completa</option>
    <option value="lavagem-especial">Lavagem Especial</option>
</select>
<br><br>

        <label>Nome:</label>
        <input type="text" name="nome" required><br><br>
        <input type="submit" value="Agendar">
    </form>
</body>
</html>
<?php
// Inclua o arquivo de configuração do banco de dados (config.php)
require('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carro = $_POST['carro'];
    $horario = $_POST['horario'];
    $dia = $_POST['dia'];
    $servico = $_POST['servico'];
    $nome = $_POST['nome'];

    // Prepare a declaração SQL para inserir dados na tabela
    $sql = "INSERT INTO agendamento (Carro, Horario, Dia, Servico, Nome) VALUES (?, ?, ?, ?, ?)";

    // Prepare a declaração e execute-a
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $carro, $horario, $dia, $servico, $nome);
    
    if ($stmt->execute()) {
        echo "Agendamento realizado com sucesso.";
    } else {
        echo "Erro ao agendar: " . $stmt->error;
    }

    // Feche a declaração e a conexão
    $stmt->close();
    $conexao->close();
}
?>


