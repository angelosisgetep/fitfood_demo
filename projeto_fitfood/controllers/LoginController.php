<?php
session_start();
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Usuario.php';

$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuarioModel = new Usuario($pdo);
    $user = $usuarioModel->getByEmail($email);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        header("Location: index.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}

// Chama a interface visual
require_once __DIR__ . '/../views/login.php';
?>