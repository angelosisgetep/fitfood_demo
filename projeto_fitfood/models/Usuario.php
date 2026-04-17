<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $email, $telefone, $senhaHash) {
        $sql = "INSERT INTO usuarios (nome, email, telefone, senha) VALUES (:nome, :email, :tel, :senha)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['nome' => $nome, 'email' => $email, 'tel' => $telefone, 'senha' => $senhaHash]);
    }
}
?>