<?php
require_once '/source/Model/data/login.php';
session_start();

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
        header('Location: interface-menu.php');
        exit();
    } else {
        // Credenciais inválidas, exibe uma mensagem de erro
        $error_message = 'Nome de usuário ou senha inválidos.';
    }
}