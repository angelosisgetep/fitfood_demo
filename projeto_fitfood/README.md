# Fit Food - Projeto Integrador (PoC - Fase 2) 🚀

## 📋 Descrição do Projeto
O **Fit Food** é uma solução digital focada em delivery de refeições saudáveis. Esta Prova de Conceito (PoC) valida a viabilidade técnica de uma jornada de compra completa e segura, integrando um frontend responsivo a um ecossistema backend com persistência de dados real.

O diferencial do projeto é a **transparência nutricional**, permitindo que o usuário filtre opções por dietas específicas (Low Carb, Vegano, etc.) e visualize os macronutrientes antes de finalizar o pedido.

## 🎥 Demonstração (Vídeo de PIT)
Confira o funcionamento do protótipo funcional, demonstrando desde a autenticação até a persistência do pedido no banco de dados:

* [**Assista ao Vídeo de Demonstração (1 min)**](midia/pit_fitfood_jornada_mariana.mp4)

> *O vídeo evidencia o fluxo de cadastro, login, filtragem por dieta e a finalização de pedido com checkout dinâmico.*

## 🎯 Jornada Selecionada (PoC)
Para esta fase, validamos a jornada crítica do usuário:
1. **Autenticação:** Cadastro de novo usuário e Login seguro com hash de senha.
2. **Personalização:** Filtragem de cardápio por protocolo dietético (Low Carb/Vegano).
3. **Informação:** Visualização de macros (Calorias, Proteínas, Carboidratos).
4. **Checkout Dinâmico:** Seleção entre Entrega (com endereço) ou Retirada.
5. **Persistência:** Registro transacional do pedido no MySQL via PDO.

## 🛠️ Stack Tecnológica
* **Frontend:** HTML5, CSS3 (Bootstrap 5) e JavaScript Assíncrono.
* **Backend:** PHP 8.2 (Arquitetura organizada por responsabilidades).
* **Banco de Dados:** MySQL com driver **PDO** para segurança contra SQL Injection.
* **Ambiente:** XAMPP / Servidor Apache.

## 🏗️ Arquitetura (Estrutura de Pastas)
```text
projeto_fitfood/
├── assets/          # Arquivos estáticos (CSS, JS e Imagens dos pratos)
├── config/          # Configurações globais e conexão PDO
├── database/        # Script SQL (DDL/DML) e carga inicial de dados
├── includes/        # Lógica de processamento e busca de dados (Backend)
├── midia/           # Vídeo de demonstração do PIT (.mp4)
├── index.php        # Vitrine de pratos (Página Principal Protegida)
├── login.php        # Sistema de autenticação
├── cadastro.php     # Registro de novos usuários
├── carrinho.php     # Checkout dinâmico (Entrega vs Retirada)
├── sucesso.php      # Feedback dinâmico e comprovante do pedido
├── logout.php       # Encerramento de sessão
└── README.md        # Documentação técnica```
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

Felipe C. Vianna Pereira

Flavia Rodrigues Moraes Biagioni

Leonardo Guardiola Vargas

Matheus Reis Silva

Miryam da Silva Souza

Rodrigo dos Anjos Silva

Vinicius Fernandes de Carvalho Lopes

Este projeto é uma entrega acadêmica para o curso de Tecnologia em Análise e Desenvolvimento de Sistemas (SENAC) - Fase 2.
