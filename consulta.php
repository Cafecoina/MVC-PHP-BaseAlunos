<?php
// Conexão com o banco de dados (substitua pelas suas configurações)
$servername = "www.coconline.com.br";
$username = "coconline_webdev";
$password = "AZPZt;-TL-7Y";
$dbname = "coconline_bancoalunos";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Termo digitado no campo de entrada
$term = $_GET["term"];

// Consulta SQL para buscar os nomes de acordo com o termo digitado
$nomeQuery = "SELECT nome FROM `Alunos Aprovados` WHERE nome LIKE '%" . $term . "%'";

// Consulta SQL para buscar os vestibulares de acordo com o termo digitado
$vestibularQuery = "SELECT vestibular FROM `Alunos Aprovados` WHERE vestibular LIKE '%" . $term . "%'";

$nomes = array();
$vestibulares = array();

// Executa a consulta para o campo "nome"
$resultNome = $conn->query($nomeQuery);
if ($resultNome->num_rows > 0) {
    while ($row = $resultNome->fetch_assoc()) {
        $nomes[] = $row["nome"];
    }
}

// Executa a consulta para o campo "vestibular"
$resultVestibular = $conn->query($vestibularQuery);
if ($resultVestibular->num_rows > 0) {
    while ($row = $resultVestibular->fetch_assoc()) {
        $vestibulares[] = $row["vestibular"];
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Cria um array final contendo os arrays de nomes e vestibulares
$resultados = array(
    "nomes" => $nomes,
    "vestibulares" => $vestibulares
);

// Retorna os resultados em formato JSON
echo json_encode($resultados);
?>
