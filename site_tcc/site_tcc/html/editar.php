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
    <title>Editar Agendamento</title>
</head>
<body>
    <h1>Editar Agendamento</h1>

    <?php
    require('config.php'); // Importa o arquivo de configuração do banco de dados

    if (isset($_GET['id'])) {
        $idAgendamento = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Processar os dados do formulário de edição e atualizar o banco de dados

            $carro = $_POST['carro'];
            $horario = $_POST['horario'];
            $dia = $_POST['dia'];
            $servico = $_POST['servico'];
            $nome = $_POST['nome'];

            $sql = "UPDATE agendamento SET carro = ?, horario = ?, dia = ?, servico = ?, nome = ? WHERE idAgendamento = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sssssi", $carro, $horario, $dia, $servico, $nome, $idAgendamento);

            if ($stmt->execute()) {
                echo "Agendamento atualizado com sucesso.";
            } else {
                echo "Erro ao atualizar o agendamento: " . $stmt->error;
            }
        }

        // Recuperar os dados do agendamento para exibição no formulário de edição
        $sql = "SELECT * FROM agendamento WHERE idAgendamento = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $idAgendamento);
        $stmt->execute();
        $result = $stmt->get_result();
        $agendamento = $result->fetch_assoc();
    }
    ?>

    <form method="post">
        <label>Carro:</label>
        <input type="text" name="carro" value="<?php echo $agendamento['carro']; ?>"><br><br>
        <label>Horário:</label>
        <input type="time" name="horario" value="<?php echo $agendamento['horario']; ?>"><br><br>
        <label>Dia:</label>
        <input type="date" name="dia" value="<?php echo $agendamento['dia']; ?>"><br><br>
        <label>Serviço:</label>
        <input type="text" name="servico" value="<?php echo $agendamento['servico']; ?>"><br><br>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $agendamento['nome']; ?>"><br><br>
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
