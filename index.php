<?php
require_once './vendor/autoload.php';

session_start();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém as credenciais do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Define os logins fixos
    $logins = array(
        'cocrds' => 'Coc@2023',
        'coclg' => 'Coc@2023',
        'cocbc' => 'Coc@2023',
        'cocblu' => 'Coc@2023'
    );

    // Verifica se as credenciais são válidas
    if (isset($logins[$username]) && $logins[$username] === $password) {
        // Define a variável de sessão para indicar que o usuário está autenticado
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redireciona para a página de upload de imagens
        header('Location: interface-menu.php');
        exit();
    } else {
        // Credenciais inválidas, exibe uma mensagem de erro
        $error_message = 'Nome de usuário ou senha inválidos.';
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="./assets/css/style-login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body id="pg-login">
    <div class="container">
        <div class="logo">
            <img src="./assets/IMG/logo-login.png" alt="Logo da Empresa">
        </div>
        <div class="login-form text-center">
            <h2 class="mb-4">Base de Alunos <span>Aprovados</span></h2>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Nome de usuário" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Senha" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>
                <?php if (isset($error_message)) : ?>
                    <div class="mt-3 text-center">
                        <span class="text-danger">
                            <?php echo $error_message; ?>
                        </span>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="footer">
            <p>©2023 - Todos direitos reservados - NotaMáxima</p>
        </div>
    </div>

    <script>
        function carregarImagemDeFundo() {
            const accessKey = 'r0WCPhhzSpWTykWO0KYIcqhFBIraTFah3yNQUfybERY';
            const theme = 'nature'; // Substitua com o tema desejado

            // Parâmetros da busca
            const params = new URLSearchParams({
                client_id: accessKey,
                orientation: 'landscape',
                query: theme,
                count: 1
            });

            // Faz uma chamada à API do Unsplash para buscar uma imagem aleatória
            fetch(`https://api.unsplash.com/photos/random?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    // Obtém a URL da imagem aleatória
                    const imageUrl = data[0]?.urls?.regular;

                    // Define a imagem como background do body usando CSS
                    document.body.style.backgroundImage = `url(${imageUrl})`;
                })
                .catch(error => {
                    console.log(error);
                    // Define a imagem padrão como background do body caso ocorra um erro
                    document.body.style.backgroundImage = 'url(https://images.unsplash.com/photo-1682687220566-5599dbbebf11?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1075&q=80)';
                });
        }

        // Chama a função para carregar a imagem de fundo quando a página é carregada
        carregarImagemDeFundo();
    </script>
</body>

</html>