<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fit Food - Pedido Confirmado!</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --fit-verde: #157347; --fit-verde-escuro: #0f5132; }
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; }
        .navbar-brand { font-weight: 700; color: var(--fit-verde) !important; letter-spacing: -1px; }
        .user-badge { background: #d1e7dd; color: var(--fit-verde-escuro); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .receipt-card { background: white; border-radius: 20px; padding: 40px; max-width: 550px; width: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .success-circle { width: 80px; height: 80px; background: var(--fit-verde); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(21, 115, 71, 0.3); }
        .table-receipt td { padding: 14px 0; border-bottom: 1px solid #f1f3f5; font-size: 0.95rem; }
        .status-badge { background: #d1e7dd; color: var(--fit-verde-escuro); padding: 6px 15px; border-radius: 50px; font-weight: 700; display: inline-block; margin-bottom: 15px; text-uppercase; font-size: 0.75rem; }
        .btn-home { background: var(--fit-verde); color: white; font-weight: 700; padding: 16px; border-radius: 12px; border: none; transition: 0.3s; text-decoration: none; display: block; }
        .btn-home:hover { background: var(--fit-verde-escuro); color: white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">FIT FOOD</a>
            <div class="ms-auto">
                <span class="user-badge text-uppercase">👤 <?= htmlspecialchars($_SESSION['user_name']) ?></span>
            </div>
        </div>
    </nav>
    <div class="container d-flex justify-content-center py-4">
        <div class="receipt-card text-center">
            <div class="success-circle">✓</div>
            <div class="status-badge">Pedido em Produção</div>
            <h3 class="fw-bold mb-1" style="color: var(--fit-verde-escuro);">Tudo certo, <?= htmlspecialchars($primeiro_nome) ?>! Agradecemos a preferência!</h3>
            <p class="text-muted small mb-4">Seu pedido foi registrado com sucesso.</p>
            <table class="table table-borderless table-receipt my-4 text-start">
                <tr><td class="text-muted">ID do Pedido:</td><td class="text-end fw-bold">#FF-<?= rand(1000, 9999) ?></td></tr>
                <tr>
                    <td class="text-muted align-top pt-2">Itens:</td>
                    <td class="text-end pt-2">
                        <?php if (!empty($itens_comprados)): ?>
                            <?php foreach ($itens_comprados as $item): ?>
                                <div class="mb-1 text-truncate" style="max-width: 250px; display: inline-block; vertical-align: bottom;" title="<?= htmlspecialchars($item['nome']) ?>"><?= htmlspecialchars($item['nome']) ?></div>
                                <strong class="text-dark ms-1">x<?= $item['qtd'] ?></strong><br>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr><td class="text-muted">Entrega:</td><td class="text-end"><?= htmlspecialchars($endereco_final) ?></td></tr>
                <tr><td class="text-muted">Pagamento:</td><td class="text-end"><?= htmlspecialchars($pagamento_exibicao) ?></td></tr>
                <tr><td class="fw-bold text-dark">Total Pago:</td><td class="text-end fw-bold h5 mb-0" style="color: var(--fit-verde);">R$ <?= number_format($total, 2, ',', '.') ?></td></tr>
            </table>
            <div class="d-grid gap-2">
                <a href="index.php" class="btn btn-home shadow-sm">Realizar novo pedido</a>
                <button onclick="window.print()" class="btn btn-link text-muted text-decoration-none small">Baixar comprovante</button>
            </div>
        </div>
    </div>
</body>
</html>
