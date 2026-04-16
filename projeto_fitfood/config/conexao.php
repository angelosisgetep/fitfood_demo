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
} catch (PDOException $e) {
    // Se der erro, para o script e mostra o motivo
    die("Erro na conexão: " . $e->getMessage());
}
?>