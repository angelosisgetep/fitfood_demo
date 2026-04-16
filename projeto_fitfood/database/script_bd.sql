-- 1. Criação da Tabela de Categorias (Protocolos Dietéticos)
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

-- 2. Criação da Tabela de Pratos/Refeições
CREATE TABLE IF NOT EXISTS pratos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    calorias INT NOT NULL,
    proteinas DECIMAL(5,2) NOT NULL, -- em gramas
    carboidratos DECIMAL(5,2) NOT NULL, -- em gramas
    gorduras DECIMAL(5,2) NOT NULL, -- em gramas
    preco DECIMAL(10,2) NOT NULL,
    imagem_url VARCHAR(255),
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- 3. Inserindo as Categorias baseadas no seu projeto
INSERT INTO categorias (nome) VALUES 
('Low Carb'), 
('Vegano'), 
('Sem Glúten'), 
('High Protein');

-- 4. Inserindo Pratos de Exemplo para a PoC (Jornada da Mariana)
-- Vamos focar no Low Carb que é o seu cenário principal
INSERT INTO pratos (nome, descricao, calorias, proteinas, carboidratos, gorduras, preco, categoria_id) VALUES 
('Frango Grelhado com Aspargos', 'Peito de frango marinado em ervas finas acompanhado de aspargos grelhados no azeite.', 320, 45.5, 8.2, 10.5, 32.90, 1),
('Salmão ao Molho de Alcaparras', 'Filé de salmão grelhado com legumes salteados (brócolis e couve-flor).', 410, 38.0, 5.5, 22.0, 48.00, 1),
('Omelete Fit de Espinafre', 'Omelete de claras e ovos inteiros com espinafre fresco e queijo branco.', 280, 22.0, 4.0, 15.0, 22.50, 1),
('Bowl Vegano de Grão de Bico', 'Mix de folhas verdes, grão de bico temperado, tomate cereja e quinoa.', 450, 18.0, 55.0, 12.0, 28.90, 2);


-- 5. Criação da Tabela de Pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prato_id INT NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Realizado',
    FOREIGN KEY (prato_id) REFERENCES pratos(id)
);

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);