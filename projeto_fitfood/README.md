# Fit Food - Projeto Integrador (PoC - Fase 2) 🚀

## 📋 Descrição do Projeto
O **Fit Food** é uma solução digital focada em delivery de refeições saudáveis. Esta Prova de Conceito (PoC) valida a viabilidade técnica de uma jornada de compra completa e segura, integrando um frontend responsivo a um ecossistema backend com persistência de dados real.

O diferencial do projeto é a **transparência nutricional**, permitindo que o usuário filtre opções por dietas específicas (Low Carb, Vegano, etc.) e visualize os macronutrientes antes de finalizar o pedido.

## 🎥 Demonstração (Vídeo de PIT)
Confira o funcionamento do protótipo funcional, demonstrando desde a autenticação até a persistência do pedido no banco de dados:

* [**Assista ao Vídeo de Demonstração (1 min)**](midia/fitfood_jornada_mariana.mp4)

> *O vídeo evidencia o fluxo de cadastro, login, filtragem por dieta e a finalização de pedido com checkout dinâmico.*

## 🎯 Jornada Selecionada (PoC)
Para esta fase, validamos a jornada crítica do usuário:
1.  **Autenticação Segura:** Cadastro de novos usuários com senhas criptografadas e sistema de login.
2.  **Vitrine Inteligente:** Cardápio com filtros por categoria (Low Carb, Vegano) e exibição clara de macronutrientes.
3.  **Carrinho de Compras Assíncrono (Multi-itens):**
    *   Adição de múltiplos pratos ao carrinho sem recarregar a página (via Fetch API).
    *   Modal para ajuste de quantidade no momento da adição.
    *   Modal de revisão do carrinho, permitindo alterar quantidades ou remover itens em tempo real.
4.  **Checkout Transparente:** Etapa final para seleção de tipo de entrega, endereço e forma de pagamento.
5.  **Persistência e Recibo:** Registro de todos os itens do pedido no banco de dados (MySQL com PDO) e geração de um comprovante detalhado e seguro (sem expor dados na URL).

## 🛠️ Stack Tecnológica
* **Frontend:** HTML5, CSS3 (Bootstrap 5) e **JavaScript Assíncrono (Fetch API)**.
* **Backend:** PHP 8.2 (Arquitetura organizada por responsabilidades).
* **Banco de Dados:** MySQL com driver **PDO** para segurança contra SQL Injection.
* **Ambiente:** XAMPP / Servidor Apache.

## 🏗️ Arquitetura (Estrutura de Pastas)
```text
projeto_fitfood/
├── assets/          # Arquivos estáticos (CSS, JS, Imagens)
├── config/          # Configurações globais e conexão PDO
├── controllers/     # Controladores (Regras de negócio e fluxo)
├── database/        # Script SQL (DDL/DML) e carga inicial de dados
├── models/          # Modelos (Comunicação com o banco de dados)
├── views/           # Interfaces de usuário (HTML/PHP)
├── midia/           # Vídeo de demonstração do PIT (.mp4)
├── index.php        # Ponto de entrada (Vitrine)
├── login.php        # Ponto de entrada (Autenticação)
├── cadastro.php     # Ponto de entrada (Registro)
├── carrinho.php     # Ponto de entrada (Checkout)
├── logout.php       # Encerramento de sessão
└── README.md        # Documentação técnica
```

🚀 Como Executar o Projeto
Pré-requisitos
Servidor Local: XAMPP, WAMP ou Laragon (Apache e MySQL ativos).

PHP: Versão 8.0 ou superior.

Passo a Passo
Diretório: Clone ou copie a pasta projeto_fitfood para dentro do seu diretório de servidor (ex: C:\xampp\htdocs\).

Banco de Dados:

Acesse o phpMyAdmin (http://localhost/phpmyadmin).

Crie um banco de dados chamado fit_food_db.

Importe o arquivo localizado em database/script_bd.sql.

Configuração: Caso suas credenciais de banco sejam diferentes do padrão (root/vazio), ajuste o arquivo config/conexao.php.

Acesso: Abra o navegador e digite: http://localhost/projeto_fitfood/login.php.

👥 Integrantes e Colaboradores (SENAC Blumenau/SC)
Angelo Dell’Agnolo Junior - Backend, Banco de Dados e Arquitetura.

Felipe C. Vianna Pereira - Verificação de código e estrutura.

Flavia Rodrigues Moraes Biagioni

Leonardo Guardiola Vargas - Validação de código e testes na ferramenta.

Matheus Reis Silva

Miryam da Silva Souza

Rodrigo dos Anjos Silva

Vinicius Fernandes de Carvalho Lopes

Este projeto é uma entrega acadêmica para o curso de Tecnologia em Análise e Desenvolvimento de Sistemas (SENAC) - Fase 2.