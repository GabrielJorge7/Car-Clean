<style>
    body {
        background-color: #3498db; /* Azul sólido como fundo */
        color: #000; /* Texto preto */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #3498db; /* Azul */
        color: #fff; /* Texto branco */
        text-align: center;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px auto;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #3498db; /* Azul */
        color: #fff; /* Texto branco */
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* Fundo cinza claro para linhas pares */
    }

    tr:nth-child(odd) {
        background-color: #fff; /* Fundo branco para linhas ímpares */
    }

    a {
        text-decoration: none;
        color: #3498db; /* Azul para links */
    }

    a:hover {
        text-decoration: underline;
    }
</style>





    <title>Agendamentos</title>
</head>
<body>
    <header>
        <h3>Agendamentos</h3>
    </header>

    <?php
   
   require('config.php'); //server para realizar consultas ao banco
   
   

   

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    $sql = "SELECT * FROM agendamento";
    $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao));

    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Carro</th>';
    echo '<th>Horario</th>';
    echo '<th>Dia</th>';
    echo '<th>Servico</th>';
    echo '<th>Nome</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($dados = mysqli_fetch_assoc($rs)) {
        echo '<tr>';
        echo '<td>' . $dados["idAgendamento"] . '</td>';
        echo '<td>' . $dados["carro"] . '</td>';
        echo '<td>' . $dados["horario"] . '</td>';
        echo '<td>' . $dados["dia"] . '</td>';
        echo '<td>' . $dados["servico"] . '</td>';
        echo '<td>' . $dados["nome"] . '</td>';
        echo '<td><a href="editar.php?id=' . $dados["idAgendamento"] . '">Editar</a> | <a href="excluir.php?id=' . $dados["idAgendamento"] . '">Excluir</a></td>';

        echo '</tr>';
    }
    

    echo '</tbody>';
    echo '</table>';

    $conexao->close();
    
    ?>
    <?php
session_start();
require('config.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Verifica se o usuário é um administrador (admin = 1)
$usuario = $_SESSION['usuario'];
$sql = "SELECT admin FROM cliente WHERE usuario = '$usuario'";
$result = $conexao->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row['admin'] != 1) {
        // Redireciona para index.php se o usuário não for administrador
        header('Location: index.php');
        exit;
    }
}

// O restante do seu código para exibir a lista de agendamentos aqui
?>

</body>
</html>