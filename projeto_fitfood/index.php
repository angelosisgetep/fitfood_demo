<?php 
session_start();
require_once 'config/conexao.php'; // Se estiver na raiz, o caminho é este mesmo.

// 1. Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// 2. Importa os dados dos pratos
include 'includes/get_pratos.php'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Food - Cardápio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { 
            --fit-verde: #157347; 
            --fit-verde-escuro: #0f5132; 
            --bg-suave: #f8f9fa;
        }
        
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-suave); }
        
        /* Navbar */
        .navbar-brand { font-weight: 700; color: var(--fit-verde) !important; letter-spacing: -1px; }
        .user-badge { background: #d1e7dd; color: var(--fit-verde-escuro); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        
        /* Cards */
        .card { border: none; border-radius: 16px; transition: 0.3s; overflow: hidden; background: white; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
        
        /* Container da Imagem com Efeito Zoom */
        .img-container { height: 200px; overflow: hidden; position: relative; background: #eee; }
        .img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .card:hover .img-container img { transform: scale(1.1); }

        /* Botão Personalizado */
        .btn-fit { background: var(--fit-verde); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 10px 20px; transition: 0.3s; }
        .btn-fit:hover { background: var(--fit-verde-escuro); color: white; box-shadow: 0 4px 12px rgba(21, 115, 71, 0.2); }
        
        /* Detalhes */
        .price-tag { color: var(--fit-verde-escuro); font-weight: 700; font-size: 1.3rem; }
        .badge-nutri { background: #f1f3f5; color: #495057; border-radius: 6px; font-weight: 700; font-size: 0.7rem; padding: 6px 10px; }
        .filter-btn { border-radius: 25px; padding: 8px 24px; font-weight: 600; transition: 0.3s; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">FIT FOOD</a>
            <div class="ms-auto">
                <span class="user-badge text-uppercase">👤 <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="logout.php" class="btn btn-sm btn-link text-muted ms-2">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="text-center my-5">
            <h1 class="fw-bold" style="color: var(--fit-verde-escuro);">O que pretende comer hoje?</h1>
            <p class="text-muted">Refeições frescas, saudáveis e pensadas para o seu objetivo.</p>
        </div>

        <div class="d-flex justify-content-center gap-2 mb-5">
            <a href="index.php" class="btn btn-outline-secondary filter-btn">Todos</a>
            <a href="index.php?categoria=1" class="btn btn-outline-success filter-btn">Low Carb</a>
            <a href="index.php?categoria=2" class="btn btn-outline-success filter-btn">Veganos</a>
        </div>

        <div class="row">
            <?php foreach ($pratos as $p): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    
                    <div class="img-container">
                        <?php 
                            $caminho_img = "assets/img/" . $p['id'] . ".jpg"; 
                            $img_exibir = file_exists($caminho_img) ? $caminho_img : "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop";
                        ?>
                        <img src="<?= $img_exibir ?>" alt="<?= $p['nome'] ?>">
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-2">
                            <h5 class="fw-bold text-dark mb-1"><?= $p['nome'] ?></h5>
                            <p class="text-muted small lh-sm" style="height: 45px; overflow: hidden;"><?= $p['descricao'] ?></p>
                        </div>
                        
                        <div class="d-flex gap-2 mb-4">
                            <span class="badge badge-nutri text-uppercase">🔥 <?= $p['calorias'] ?> kcal</span>
                            <span class="badge badge-nutri text-uppercase">💪 <?= $p['proteinas'] ?>g prot</span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="price-tag">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                            <a href="carrinho.php?id=<?= $p['id'] ?>" class="btn btn-fit shadow-sm">
                                Adicionar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>