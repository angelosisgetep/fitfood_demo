document.addEventListener('DOMContentLoaded', () => {
    const modalElement = document.getElementById('carrinhoModal');
    if (!modalElement) return;

    const modal = new bootstrap.Modal(modalElement);
    let pratoAtual = { id: null, nome: '', preco: 0, qtd: 1 };

    const formatarMoeda = (valor) => 'R$ ' + parseFloat(valor).toFixed(2).replace('.', ',');

    const atualizarModal = () => {
        document.getElementById('inputQtd').value = pratoAtual.qtd;
        document.getElementById('modalTotal').textContent = formatarMoeda(pratoAtual.preco * pratoAtual.qtd);
    };

    document.querySelectorAll('.btn-add-carrinho').forEach(btn => {
        btn.addEventListener('click', () => {
            pratoAtual = { id: btn.dataset.id, nome: btn.dataset.nome, preco: parseFloat(btn.dataset.preco), qtd: 1 };
            document.getElementById('modalPratoNome').textContent = pratoAtual.nome;
            document.getElementById('modalPratoPrecoUnitario').textContent = 'Unidade: ' + formatarMoeda(pratoAtual.preco);
            atualizarModal();
            modal.show();
        });
    });

    document.getElementById('btnMinus').addEventListener('click', () => { if (pratoAtual.qtd > 1) { pratoAtual.qtd--; atualizarModal(); } });
    document.getElementById('btnPlus').addEventListener('click', () => { pratoAtual.qtd++; atualizarModal(); });
    
    document.getElementById('btnAdicionarMais').addEventListener('click', () => { 
        fetch(`index.php?action=add_carrinho&id=${pratoAtual.id}&qtd=${pratoAtual.qtd}`)
            .then(r => r.json())
            .then(data => {
                document.getElementById('cart-badge').textContent = data.count;
                modal.hide();
            });
    });

    document.getElementById('btnProsseguir').addEventListener('click', () => { 
        fetch(`index.php?action=add_carrinho&id=${pratoAtual.id}&qtd=${pratoAtual.qtd}`)
            .then(() => { window.location.href = 'carrinho.php'; });
    });

    // Lógica para o Modal de Revisão do Carrinho
    const btnAbrirCarrinho = document.getElementById('btnAbrirCarrinho');
    const modalVerCarrinhoElement = document.getElementById('modalVerCarrinho');
    
    if (btnAbrirCarrinho && modalVerCarrinhoElement) {
        const modalVerCarrinho = new bootstrap.Modal(modalVerCarrinhoElement);
        
        btnAbrirCarrinho.addEventListener('click', () => {
            carregarCarrinho();
        });

        function carregarCarrinho() {
            fetch('index.php?action=get_carrinho')
                .then(r => r.json())
                .then(data => {
                    const container = document.getElementById('carrinhoItensContainer');
                    container.innerHTML = '';

                    if (!data.itens || data.itens.length === 0) {
                        container.innerHTML = '<p class="text-center text-muted my-4">Seu carrinho está vazio.</p>';
                        document.getElementById('btnFinalizarCarrinho').classList.add('disabled');
                    } else {
                        document.getElementById('btnFinalizarCarrinho').classList.remove('disabled');
                        data.itens.forEach(item => {
                            container.innerHTML += `
                                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                                    <div style="flex: 1;">
                                        <h6 class="fw-bold mb-1 text-truncate" style="max-width: 150px;" title="${item.nome}">${item.nome}</h6>
                                        <span class="text-muted small">${formatarMoeda(item.preco)} un.</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="input-group input-group-sm" style="width: 90px;">
                                            <button class="btn btn-outline-secondary fw-bold btn-update-carrinho" data-id="${item.id}" data-qtd="${item.qtd - 1}">-</button>
                                            <input type="text" class="form-control text-center fw-bold bg-white px-0" value="${item.qtd}" readonly>
                                            <button class="btn btn-outline-secondary fw-bold btn-update-carrinho" data-id="${item.id}" data-qtd="${item.qtd + 1}">+</button>
                                        </div>
                                        <span class="fw-bold text-dark text-end" style="min-width: 70px;">${formatarMoeda(item.subtotal)}</span>
                                    </div>
                                </div>
                            `;
                        });
                    }
                    
                    document.getElementById('modalVerCarrinhoTotal').textContent = formatarMoeda(data.total || 0);

                    document.querySelectorAll('.btn-update-carrinho').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const id = this.dataset.id;
                            const qtd = this.dataset.qtd;
                            fetch(`index.php?action=update_carrinho&id=${id}&qtd=${qtd}`)
                                .then(r => r.json())
                                .then(res => {
                                    document.getElementById('cart-badge').textContent = res.count;
                                    carregarCarrinho(); // Recarrega para refletir a remoção/edição
                                });
                        });
                    });

                    modalVerCarrinho.show();
                });
        }
    }
});