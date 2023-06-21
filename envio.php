<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se a caixa de seleção está marcada
    if (isset($_POST['unicoaluno1'])) {
        // Obtém os valores dos campos do formulário e realiza o escape dos dados
        // Obtém os valores dos campos do formulário
        $nome = $_POST['field1'];
        $unidade = $_POST['Unidade'];
        $turma = $_POST['Turma'];
        $ano = $_POST['Ano'];
        $descricao = $_POST['descricao'];
        $vestibular = $_POST['vestibular'];


        // Verifica se algum dos selects contém o valor "ph1", "ph2" ou "ph3"
        if (strpos($unidade, 'ph1') === false && strpos($turma, 'ph2') === false && strpos($ano, 'ph3') === false) {
            // Realiza o envio dos dados para o banco de dados MySQL
            // Configurações do banco de dados
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

            // Prepara a consulta SQL
            $sql = "INSERT INTO `Alunos Aprovados` (nome, unidade, turma, ano, descricao, vestibular) VALUES (?, ?, ?, ?, ?, ?)";


            // Prepara a instrução SQL
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $nome, $unidade, $turma, $ano, $descricao, $vestibular);


            echo $conn->error;
            // Executa a instrução SQL
            if ($stmt->execute()) {
                $error_message = "Dados enviados com sucesso para o banco de dados.";
            } else {
                $error_message = "Erro ao enviar os dados para o banco de dados: " . $stmt->error;
            }

            // Fecha a instrução e a conexão com o banco de dados
            $stmt->close();
            $conn->close();

            // Verificar se a variável $imagens é um array
            $pastaAlunos = $_SERVER['DOCUMENT_ROOT'] . '/basealunosaprovados/alunos/';
            $imagens = $_FILES['imagem']['tmp_name'];
            if (is_array($imagens)) {
                $numImagens = count($imagens);
                $destinos = array();

                // Loop para processar as imagens
                foreach ($imagens as $key => $imagem) {
                    $extensao = pathinfo($_FILES['imagem']['name'][$key], PATHINFO_EXTENSION);
                    $novoNome = $nome . '_' . date('YmdHis') . '_' . ($key + 1) . '.' . $extensao;
                    $diretorioAlunos = $pastaAlunos . $unidade . '/' . $ano . '/' . $turma . '/' . $vestibular . '/' . $nome;
                    $destino = $diretorioAlunos . '/' . $novoNome;

                    // Verifica se o diretório de destino existe, caso contrário, cria o diretório
                    if (!is_dir($diretorioAlunos)) {
                        mkdir($diretorioAlunos, 0755, true);
                    }

                    move_uploaded_file($imagem, $destino);
                    $destinos[] = $destino;
                }
            } else {
                // A variável $imagens não é um array, lidar com o erro
                $error_message = 'Erro: as imagens não foram enviadas corretamente.';
            }
        } else {
            // Exibe uma mensagem de erro informando que os campos não foram preenchidos corretamente
            $error_message = 'Por favor, preencha todos os campos corretamente.';
        }
    } else {
        // Exibe uma mensagem de erro informando que a caixa de seleção não está marcada
        $error_message = 'Você precisa concordar que todas as imagens pertencem ao mesmo aluno.';
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>
    <!-- Inclua aqui os links para os estilos CSS do Bootstrap -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="card-title">Upload de Imagens</h1>

                <!-- Coloque este trecho no local adequado do seu HTML -->
                <?php if (isset($error_message)) : ?>
                    <div class="mt-3 text-center">
                        <span class="text-danger">
                            <?php echo $error_message; ?>
                        </span>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Inclua aqui os scripts JavaScript/jQuery para a validação do formulário -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>