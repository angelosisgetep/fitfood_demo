<?php
// Puxa o arquivo de conexão que acabamos de criar
require_once __DIR__ . '/../config/conexao.php';

// Verifica se o usuário clicou em algum filtro (Low Carb ou Vegano)
$categoria_id = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;

if ($categoria_id) {
    // Busca pratos de uma categoria específica
    $sql = "SELECT * FROM pratos WHERE categoria_id = :cat";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['cat' => $categoria_id]);
} else {
    // Busca todos os pratos
    $sql = "SELECT * FROM pratos";
    $stmt = $pdo->query($sql);
}

// Guarda o resultado na variável $pratos para usar no HTML
$pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>