<?php
class Prato {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM pratos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategoria($categoria_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pratos WHERE categoria_id = :cat");
        $stmt->execute(['cat' => $categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pratos WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>