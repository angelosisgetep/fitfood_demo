<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Valida se existe um recibo na sessão para ser exibido
if (!isset($_SESSION['ultimo_pedido_recibo'])) {
    header("Location: index.php");
    exit;
}

$recibo = $_SESSION['ultimo_pedido_recibo'];
unset($_SESSION['ultimo_pedido_recibo']); // Limpa a sessão para não reexibir ao recarregar

$endereco_final = $recibo['entrega'] ?? 'Rua não informada';
$metodo_pagamento = $recibo['metodo'] ?? 'Cartão';
$total = $recibo['total'] ?? 0;
$itens_comprados = $recibo['itens'] ?? [];

// Mapeia os valores do BD para textos amigáveis
$pagamentos_labels = [
    'pix' => 'Pix (5% OFF)',
    'cartao_credito' => 'Cartão de Crédito',
    'cartao_debito' => 'Cartão de Débito',
    'vale_refeicao' => 'Vale Refeição'
];
$pagamento_exibicao = $pagamentos_labels[$metodo_pagamento] ?? $metodo_pagamento;
$primeiro_nome = explode(' ', $_SESSION['user_name'])[0];

// Chama a interface visual
require_once __DIR__ . '/../views/sucesso.php';
?>