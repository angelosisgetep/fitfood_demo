<?php
class Pedido {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($prato_id, $usuario_id, $quantidade, $tipo_entrega, $endereco_entrega, $metodo_pagamento) {
        $sql = "INSERT INTO pedidos (prato_id, usuario_id, quantidade, tipo_entrega, endereco_entrega, metodo_pagamento, status) 
                VALUES (:prato_id, :usuario_id, :quantidade, :tipo_entrega, :endereco_entrega, :metodo_pagamento, 'Realizado')";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':prato_id', $prato_id, PDO::PARAM_INT);
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(':tipo_entrega', $tipo_entrega);
        $stmt->bindValue(':endereco_entrega', $endereco_entrega);
        $stmt->bindValue(':metodo_pagamento', $metodo_pagamento);
        
        return $stmt->execute();
    }
}
?>