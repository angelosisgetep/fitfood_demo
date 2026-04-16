<?php
require_once __DIR__ . '/../config/conexao.php';

// Mudamos para POST para receber os dados do formulário do carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prato_id'])) {
    $prato_id = (int)$_POST['prato_id'];
    $tipo_entrega = $_POST['tipo_entrega'] ?? 'entrega';
    $pagamento = $_POST['pagamento'] ?? 'Não informado';
    
    // Se for retirada, ignoramos o endereço enviado
    $endereco = ($tipo_entrega === 'retirada') ? 'Retirada no Balcão' : ($_POST['endereco'] ?? 'Endereço não informado');

    try {
        // Sugestão: adicione colunas de endereco e pagamento na sua tabela 'pedidos' depois
        $sql = "INSERT INTO pedidos (prato_id) VALUES (:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $prato_id]);

        // Passamos os dados via URL para a página de sucesso
        // Usamos urlencode para garantir que endereços com espaços/acentos não quebrem a URL
        $params = http_build_query([
            'id' => $prato_id,
            'entrega' => $endereco,
            'metodo' => $pagamento
        ]);

        header("Location: ../sucesso.php?" . $params);
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar pedido: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>