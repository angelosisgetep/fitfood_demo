<?php 
session_start();

// Proteção de Sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';
require_once 'includes/get_pratos.php';

$id = $_GET['id'] ?? null;
$prato_selecionado = null;

if ($id) {
    foreach ($pratos as $p) { 
        if ($p['id'] == $id) { 
            $prato_selecionado = $p; 
            break; 
        } 
    }
}

if (!$prato_selecionado) { 
    header('Location: index.php'); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fit Food - Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --fit-verde: #157347; --fit-verde-escuro: #0f5132; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; color: var(--fit-verde) !important; letter-spacing: -1px; }
        .user-badge { background: #d1e7dd; color: var(--fit-verde-escuro); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .checkout-card { border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); }
        .btn-confirm { background: var(--fit-verde); color: white; border: none; font-weight: 700; padding: 16px; border-radius: 12px; transition: 0.3s; }
        .btn-confirm:hover { background: var(--fit-verde-escuro); color: white; transform: translateY(-2px); }
        .total-price { color: var(--fit-verde-escuro); font-size: 2rem; font-weight: 700; }
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

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card checkout-card p-4 p-md-5">
                    <h4 class="fw-bold mb-4 text-center">Finalizar Pedido</h4>
                    
                    <form action="includes/finalizar_pedido.php" method="POST">
                        <input type="hidden" name="prato_id" value="<?= $id ?>">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Como deseja receber?</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="entrega" value="entrega" checked>
                                    <label class="form-check-label" for="entrega">Entrega</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_entrega" id="retirada" value="retirada">
                                    <label class="form-check-label" for="retirada">Retirada</label>
                                </div>
                            </div>
                        </div>

                        <div id="area-endereco" class="mb-4">
                            <label for="endereco" class="form-label fw-bold">Endereço de Entrega</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, número, bairro..." required>
                        </div>

                        <div class="mb-4">
                            <label for="pagamento" class="form-label fw-bold">Forma de Pagamento</label>
                            <select class="form-select" id="pagamento" name="pagamento" required>
                                <option value="" selected disabled>Selecione...</option>
                                <option value="pix">Pix (Desconto 5%)</option>
                                <option value="cartao_credito">Cartão de Crédito</option>
                                <option value="cartao_debito">Cartão de Débito</option>
                                <option value="vale_refeicao">Vale Refeição</option>
                            </select>
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted"><?= $prato_selecionado['nome'] ?></span>
                            <span class="fw-bold">R$ <?= number_format($prato_selecionado['preco'], 2, ',', '.') ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <span class="h6 fw-bold mb-0">TOTAL</span>
                            <span class="total-price">R$ <?= number_format($prato_selecionado['preco'], 2, ',', '.') ?></span>
                        </div>

                        <button type="submit" class="btn btn-confirm w-100 shadow-sm mb-3">Confirmar e Finalizar</button>
                        <a href="index.php" class="btn btn-link w-100 text-muted text-decoration-none small text-center">Voltar ao cardápio</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/checkout.js"></script>
</body>
</html>