<?php
// Dados do banco de dados
$host = "localhost";
$dbname = "fit_food_db";
$user = "root";
$pass = ""; 

try {
    // Cria a conexão via PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Configura o PDO para mostrar erros, caso existam
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Retorna os dados como array associativo por padrão (economiza memória e facilita a leitura)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Desativa a emulação de prepared statements (garante que o MySQL prepare a query, aumentando a segurança)
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    // Se der erro, para o script e mostra o motivo
    die("Erro na conexão: " . $e->getMessage());
}
?>