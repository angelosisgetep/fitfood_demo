<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Prato.php';
require_once __DIR__ . '/../models/Pedido.php';

// Limpar carrinho
if (isset($_GET['limpar'])) {
    unset($_SESSION['carrinho']);
    header('Location: index.php');
    exit;
}

$pratos_carrinho = [];
$total_carrinho = 0;

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: index.php');
    exit;
}

$pratoModel = new Prato($pdo);
foreach ($_SESSION['carrinho'] as $id => $qtd) {
    $prato = $pratoModel->getById($id);
    if ($prato) {
        $prato['qtd'] = $qtd;
        $prato['subtotal'] = $prato['preco'] * $qtd;
        $total_carrinho += $prato['subtotal'];
        $pratos_carrinho[] = $prato;
    }
}

// Lida com a submissão do formulário (Finalizar Compra)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar'])) {
    $tipo_entrega = $_POST['tipo_entrega'] ?? 'entrega';
    $pagamento = $_POST['pagamento'] ?? 'Não informado';
    $endereco = ($tipo_entrega === 'retirada') ? 'Retirada no Balcão' : ($_POST['endereco'] ?? 'Endereço não informado');
    $usuario_id = $_SESSION['user_id'];

    $pedidoModel = new Pedido($pdo);
    try {
        foreach ($pratos_carrinho as $item) {
            $pedidoModel->criar($item['id'], $usuario_id, $item['qtd'], $tipo_entrega, $endereco, $pagamento);
        }
        // Guarda todos os dados do recibo em uma única variável de sessão
        $_SESSION['ultimo_pedido_recibo'] = [
            'itens' => $pratos_carrinho,
            'entrega' => $endereco,
            'metodo' => $pagamento,
            'total' => $total_carrinho
        ];
        unset($_SESSION['carrinho']); // Limpa após o sucesso

        header("Location: sucesso.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar pedido: " . $e->getMessage());
    }
}

require_once __DIR__ . '/../views/carrinho.php';
?>