<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fit Food - Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --fit-verde: #157347; --fit-verde-escuro: #0f5132; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; min-height: 100vh; display: flex; align-items: center; padding: 20px 0; }
        .login-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 100%; max-width: 450px; padding: 40px; background: white; margin: auto; }
        .btn-fit { background: var(--fit-verde); color: white; border-radius: 10px; font-weight: 600; padding: 12px; width: 100%; border: none; }
        .form-control { border-radius: 10px; }
        .brand { font-weight: 700; color: var(--fit-verde); font-size: 1.8rem; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">CRIAR CONTA</div>
        <?php if ($erro): ?>
            <div class="alert alert-danger p-2 small text-center"><?= $erro ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-2">
                <label class="form-label small fw-bold">Nome Completo</label>
                <input type="text" name="nome" class="form-control form-control-sm" required>
            </div>
            <div class="row">
                <div class="col-md-7 mb-2">
                    <label class="form-label small fw-bold">E-mail</label>
                    <input type="email" name="email" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-5 mb-2">
                    <label class="form-label small fw-bold">Telefone</label>
                    <input type="text" name="telefone" class="form-control form-control-sm">
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label small fw-bold">Senha</label>
                <input type="password" name="senha" class="form-control form-control-sm" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Confirmar Senha</label>
                <input type="password" name="confirma_senha" class="form-control form-control-sm" required>
            </div>
            <div class="form-check mb-4 small">
                <input class="form-check-input" type="checkbox" required id="termos">
                <label class="form-check-label text-muted" for="termos">Aceito os termos e condições da plataforma Fit Food.</label>
            </div>
            <button type="submit" class="btn btn-fit mb-3">Cadastrar Agora</button>
            <div class="text-center">
                <a href="login.php" class="text-muted small text-decoration-none">Já tem conta? <span class="text-success fw-bold">Faça Login</span></a>
            </div>
        </form>
    </div>
</body>
</html>
