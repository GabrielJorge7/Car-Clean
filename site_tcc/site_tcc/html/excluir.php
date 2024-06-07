<?php
require('config.php'); // Importe o arquivo de configuração do banco de dados

if (isset($_GET['id'])) {
    $idAgendamento = $_GET['id'];

    $sql = "DELETE FROM agendamento WHERE idAgendamento = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $idAgendamento);

    if ($stmt->execute()) {
        echo "Agendamento excluído com sucesso.";
    } else {
        echo "Erro ao excluir o agendamento: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>
