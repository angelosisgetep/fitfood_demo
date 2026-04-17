<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Usuario.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim(htmlspecialchars($_POST['nome'] ?? ''));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = trim(htmlspecialchars($_POST['telefone'] ?? ''));
    $senha = $_POST['senha'];
    $confirma = $_POST['confirma_senha'];

    if ($senha !== $confirma) {
        $erro = "As senhas não coincidem.";
    } else {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $usuarioModel = new Usuario($pdo);
        
        try {
            $usuarioModel->criar($nome, $email, $telefone, $senhaHash);
            header("Location: login.php?sucesso=Cadastro realizado! Faça o login.");
            exit;
        } catch (PDOException $e) {
            $erro = "E-mail já cadastrado.";
        }
    }
}

// Chama a interface visual
require_once __DIR__ . '/../views/cadastro.php';
?>