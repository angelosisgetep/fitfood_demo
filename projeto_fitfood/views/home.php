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
        .navbar-brand { font-weight: 700; color: var(--fit-verde) !important; letter-spacing: -1px; }
        .user-badge { background: #d1e7dd; color: var(--fit-verde-escuro); padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }
        .card { border: none; border-radius: 16px; transition: 0.3s; overflow: hidden; background: white; }
        .card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
        .img-container { height: 200px; overflow: hidden; position: relative; background: #eee; }
        .img-container img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .card:hover .img-container img { transform: scale(1.1); }
        .btn-fit { background: var(--fit-verde); color: white; border: none; border-radius: 10px; font-weight: 600; padding: 10px 20px; transition: 0.3s; }
        .btn-fit:hover { background: var(--fit-verde-escuro); color: white; box-shadow: 0 4px 12px rgba(21, 115, 71, 0.2); }
        .price-tag { color: var(--fit-verde-escuro); font-weight: 700; font-size: 1.3rem; }
        
        /* Novos Estilos Nutricionais e Tags */
        .tag-especial { display: inline-block; background: #ffc107; color: #212529; font-weight: 700; padding: 4px 8px; border-radius: 12px; font-size: 0.65rem; vertical-align: middle; }
        .tag-especial.detox { background: #20c997; color: white; }
        .tag-especial.lowcarb { background: #0dcaf0; color: white; }
        .nutri-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 20px; }
        .nutri-item { background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 8px; text-align: center; }
        .nutri-item .nutri-val { display: block; font-weight: 800; color: var(--fit-verde-escuro); font-size: 1.05rem; line-height: 1.2; }
        .nutri-item .nutri-label { display: block; font-size: 0.65rem; color: #6c757d; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
        
        .filter-btn { border-radius: 25px; padding: 8px 24px; font-weight: 600; transition: 0.3s; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">FIT FOOD</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="user-badge text-uppercase me-2">👤 <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <button type="button" id="btnAbrirCarrinho" class="btn btn-outline-success position-relative ms-2 filter-btn" style="padding: 5px 15px;">
                    🛒 <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= isset($_SESSION['carrinho']) ? array_sum($_SESSION['carrinho']) : 0 ?>
                    </span>
                </button>
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
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="img-container">
                        <?php 
                            $caminho_img = "assets/img/" . $p['id'] . ".jpg"; 
                            $img_exibir = file_exists(__DIR__ . '/../' . $caminho_img) ? $caminho_img : "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop";
                        ?>
                        <img src="<?= $img_exibir ?>" alt="<?= $p['nome'] ?>">
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                <h5 class="fw-bold text-dark mb-0"><?= $p['nome'] ?></h5>
                                <?php if (!empty($p['tag'])): ?>
                                    <span class="tag-especial <?= $p['tag_class'] ?> flex-shrink-0"><?= $p['tag'] ?></span>
                                <?php endif; ?>
                            </div>
                            <p class="text-muted small lh-sm" style="height: 45px; overflow: hidden;"><?= $p['descricao'] ?></p>
                        </div>
                        
                        <!-- Nova Tabela/Grid Nutricional -->
                        <div class="nutri-grid mt-auto">
                            <div class="nutri-item"><span class="nutri-val"><?= $p['fmt_cal'] ?></span><span class="nutri-label">Kcal</span></div>
                            <div class="nutri-item"><span class="nutri-val"><?= $p['fmt_prot'] ?>g</span><span class="nutri-label">Proteínas</span></div>
                            <div class="nutri-item"><span class="nutri-val"><?= $p['fmt_carb'] ?>g</span><span class="nutri-label">Carboidratos</span></div>
                            <div class="nutri-item"><span class="nutri-val"><?= $p['fmt_gord'] ?>g</span><span class="nutri-label">Gorduras</span></div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="price-tag">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                            <button type="button" class="btn btn-fit shadow-sm btn-add-carrinho" 
                                    data-id="<?= $p['id'] ?>" 
                                    data-nome="<?= htmlspecialchars($p['nome'], ENT_QUOTES) ?>" 
                                    data-preco="<?= $p['preco'] ?>">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal de Prévia do Carrinho -->
    <div class="modal fade" id="carrinhoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" style="color: var(--fit-verde-escuro);">🛒 Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-0" id="modalPratoNome">Nome do Prato</h6>
                        <small class="text-muted" id="modalPratoPrecoUnitario">R$ 0,00</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded mb-3">
                        <span class="fw-bold text-dark">Quantidade</span>
                        <div class="input-group" style="width: 130px;">
                            <button class="btn btn-outline-secondary px-3 fw-bold" type="button" id="btnMinus">-</button>
                            <input type="text" class="form-control text-center fw-bold bg-white" id="inputQtd" value="1" readonly>
                            <button class="btn btn-outline-secondary px-3 fw-bold" type="button" id="btnPlus">+</button>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="h6 fw-bold mb-0">Total Calculado</span>
                        <span class="h4 fw-bold mb-0" style="color: var(--fit-verde);" id="modalTotal">R$ 0,00</span>
                    </div>
                </div>
            <div class="modal-footer border-0 bg-light d-block text-end">
                <div class="d-flex justify-content-end gap-2 mb-2">
                    <button type="button" class="btn btn-outline-success px-4" id="btnAdicionarMais">Adicionar e Continuar</button>
                    <button type="button" class="btn btn-fit px-4" id="btnProsseguir">Finalizar Carrinho</button>
                </div>
                <button type="button" class="btn btn-link text-muted text-decoration-none p-0" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal de Revisão do Carrinho -->
    <div class="modal fade" id="modalVerCarrinho" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" style="color: var(--fit-verde-escuro);">🛒 Meu Carrinho</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-4" id="carrinhoItensContainer">
                    <!-- Itens do carrinho (Injetados via JS) -->
                </div>
                <div class="modal-footer border-0 bg-light d-block text-end">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h6 fw-bold mb-0">Total:</span>
                        <span class="h4 fw-bold mb-0" style="color: var(--fit-verde);" id="modalVerCarrinhoTotal">R$ 0,00</span>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mb-2">
                        <button type="button" class="btn btn-link text-muted text-decoration-none p-0" data-bs-dismiss="modal">Continuar Comprando</button>
                        <a href="carrinho.php" class="btn btn-fit px-4" id="btnFinalizarCarrinho">Ir para Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e Lógica do Carrinho -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/home.js"></script>
</body>
</html>