<?php
session_start();
require_once 'config/conexao.php';

$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nome'];
        header("Location: index.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fit Food - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --fit-verde: #157347; --fit-verde-escuro: #0f5132; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 100%; max-width: 400px; padding: 40px; background: white; }
        .btn-fit { background: var(--fit-verde); color: white; border-radius: 10px; font-weight: 600; padding: 12px; width: 100%; border: none; }
        .btn-fit:hover { background: var(--fit-verde-escuro); color: white; }
        .form-control { border-radius: 10px; padding: 12px; }
        .brand { font-weight: 700; color: var(--fit-verde); font-size: 2rem; text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-card">
            <div class="brand">FIT FOOD</div>
            <h5 class="text-center mb-4 fw-bold">Bem-vindo de volta!</h5>
            
            <?php if ($erro): ?>
                <div class="alert alert-danger p-2 small text-center"><?= $erro ?></div>
            <?php endif; ?>
            <?php if ($sucesso): ?>
                <div class="alert alert-success p-2 small text-center"><?= $sucesso ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label small fw-bold">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="seu@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-fit mb-3">Entrar</button>
                <div class="text-center">
                    <a href="cadastro.php" class="text-muted small text-decoration-none">Não tem conta? <span class="text-success fw-bold">Cadastre-se</span></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>