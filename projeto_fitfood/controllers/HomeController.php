<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Lógica de adição ao carrinho via AJAX (Fetch API)
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    $action = $_GET['action'];
    
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    
    if ($action === 'add_carrinho') {
        $id = (int)$_GET['id'];
        $qtd = (int)$_GET['qtd'];
        $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + $qtd;
        echo json_encode(['status' => 'success', 'count' => array_sum($_SESSION['carrinho'])]);
        exit;
    }

    if ($action === 'update_carrinho') {
        $id = (int)$_GET['id'];
        $qtd = (int)$_GET['qtd'];
        if ($qtd <= 0) {
            unset($_SESSION['carrinho'][$id]); // Remove se chegar a zero
        } else {
            $_SESSION['carrinho'][$id] = $qtd;
        }
        echo json_encode(['status' => 'success', 'count' => array_sum($_SESSION['carrinho'])]);
        exit;
    }

    if ($action === 'get_carrinho') {
        require_once __DIR__ . '/../config/conexao.php';
        require_once __DIR__ . '/../models/Prato.php';
        $pratoModel = new Prato($pdo);
        $itens = [];
        $total = 0;
        foreach ($_SESSION['carrinho'] as $id => $qtd) {
            $prato = $pratoModel->getById($id);
            if ($prato) {
                $subtotal = $prato['preco'] * $qtd;
                $total += $subtotal;
                $itens[] = ['id' => $id, 'nome' => $prato['nome'], 'preco' => $prato['preco'], 'qtd' => $qtd, 'subtotal' => $subtotal];
            }
        }
        echo json_encode(['status' => 'success', 'itens' => $itens, 'total' => $total]);
        exit;
    }
}

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/Prato.php';

$pratoModel = new Prato($pdo);
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;

$pratos = $categoria_id ? $pratoModel->getByCategoria($categoria_id) : $pratoModel->getAll();

// Regras de Negócio: Definição de tags e formatação de valores nutricionais
foreach ($pratos as &$p) {
    $nome_lower = strtolower($p['nome']);
    $p['tag'] = '';
    $p['tag_class'] = '';
    
    if (strpos($nome_lower, 'grão de bico') !== false || strpos($nome_lower, 'detox') !== false) {
        $p['tag'] = '🌿 Vegano'; 
        $p['tag_class'] = 'detox';
    } elseif (strpos($nome_lower, 'frango') !== false) {
        $p['tag'] = '💪 High Protein';
    } elseif (($p['categoria_id'] ?? 0) == 1 || strpos($nome_lower, 'salada') !== false) {
        $p['tag'] = '🥗 Low Carb'; 
        $p['tag_class'] = 'lowcarb';
    }

    // Dados Nutricionais (Usando reais se existirem, ou gerando fictícios para PoC)
    $calorias_val = $p['calorias'] ?? rand(250, 450);
    $proteinas_val = $p['proteinas'] ?? (rand(150, 350) / 10);
    $carbos_val = $p['carboidratos'] ?? (rand(100, 300) / 10);
    $gorduras_val = $p['gorduras'] ?? (rand(50, 150) / 10);

    $p['fmt_cal'] = number_format((float)$calorias_val, 0, ',', '.');
    $p['fmt_prot'] = number_format((float)$proteinas_val, 1, ',', '.');
    $p['fmt_carb'] = number_format((float)$carbos_val, 1, ',', '.');
    $p['fmt_gord'] = number_format((float)$gorduras_val, 1, ',', '.');
}
unset($p); // Quebra a referência de memória do foreach

// Chama a interface visual
require_once __DIR__ . '/../views/home.php';
?>