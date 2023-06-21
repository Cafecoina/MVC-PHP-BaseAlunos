<?php
$servername = "www.coconline.com.br";
$username = "coconline_webdev";
$password = "AZPZt;-TL-7Y";
$dbname = "coconline_bancoalunos";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter o primeiro campo e a primeira linha da tabela
$sql = "SELECT * FROM `Alunos Aprovados` LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtém o primeiro campo da tabela
    $field = $result->fetch_field();
    $fieldName = $field->name;

    // Obtém a primeira linha da tabela
    $row = $result->fetch_assoc();

    // Exibe o valor do primeiro campo da primeira linha
    echo "Primeiro campo ($fieldName): " . $row[$fieldName];
} else {
    echo "Nenhum registro encontrado na tabela 'Alunos Aprovados'.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
