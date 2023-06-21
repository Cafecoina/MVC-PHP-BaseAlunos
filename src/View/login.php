<?php
session_start();

require_once '../Model/data/acessos.php';


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém as credenciais do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se as credenciais são válidas
    if (isset($logins[$username]) && $logins[$username] === $password) {
        // Define a variável de sessão para indicar que o usuário está autenticado
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redireciona para a página de upload de imagens
        header('Location: upload-form.php');
        exit();
    } else {
        // Credenciais inválidas, exibe uma mensagem de erro
        $error_message = 'Nome de usuário ou senha inválidos.';
    }
}
?>


<!-- ********************************************************************************************************* -->
<!-- ********************************************************************************************************* -->
<!-- ********************************************************************************************************* -->


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NM Base de Aprovados</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div id="pg-login" class="container">
        <!-- ******************** LOGO TOP PADRÃO ************************** -->
        <div class="logo">
            <img src="/public/imgs/logo-login.png" alt="Logo da Empresa">
        </div>
        <!-- *************************************************************** -->



        <!-- ******************** CARD LOGIN ************************** -->
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
        <!-- *************************************************************** -->



        <!-- ******************** FOOTER PADRÃO ************************** -->
        <div class="footer">
            <p>©2023 - Todos direitos reservados - NotaMáxima</p>
        </div>
        <!-- *************************************************************** -->
    </div>


    <!-- ******************** SCRIPTS ESPECIFICOS ************************** -->
    <script src="/public/js/unsplash-body-api.js"></script>
</body>

</html>








