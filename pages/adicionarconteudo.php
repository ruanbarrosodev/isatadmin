<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: /'); 
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISAT - PAINEL</title>
    <link type="text/css" rel="stylesheet" href="/public/css/main.css">
    <link type="text/css" rel="stylesheet" href="/public/css/adicionarconteudo.css">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php 
     require_once __DIR__ . '/../config/bootstrap.php';
     require_once __DIR__ . '/../utils/menu.php';
     require_once __DIR__ . '/../utils/nav.php';
    

    ?>
</head>
<body>
 <?php 
    renderNav("Katiana Ferreira", "041.525.525-04");
    ?>
<main>
    <section class="main-body">
        <?php 
            renderMenu($menuItems, $currentUri);
        ?>
        <div class="content">
          <h1>Painel de Gerenciamento</h1>
            <div class="grid-container">
            
            <!-- Bloco 1: Despesas -->
            <div class="grid-item">
                <h2>Despesas</h2>
                <form id="expense-form" method="post" action="">
                <input type="text" name="expense" placeholder="Nome da Despesa" required>
                <button type="submit">Adicionar</button>
                </form>
                <ul class="item-list" id="expense-list">
                    <!-- Vai ser populado dinamicamente -->
                </ul>
            </div>

            <!-- Bloco 2: Benefício -->
            <div class="grid-item">
                <h2>Benefício</h2>
                <form id="benefit-form" action="" method="post">
                <input type="text" name="benefit" placeholder="Nome do Benefício" required>
               <!--  <input type="text" name="typeBenefit" placeholder="Tipo do Benefício"> -->
                <select name="typeBenefit">
                    <option value="isatBenefit">ISAT Benefício</option>
                    <option value="programBenefit">Outros projetos</option>
                </select>
                <input type="text" name="qtdBenefit" placeholder="Quantidade">
                <input type="text" name="description" placeholder="Descrição">
                <button type="submit">Adicionar</button>
                </form>
                 <ul class="item-list" id="benefit-list">
                    <!-- Vai ser populado dinamicamente -->
                </ul>
            </div>

            <!-- 
            <div class="grid-item">
                <h2>Bloco 3</h2>
                <form>
                <input type="text" placeholder="Campo exemplo">
                <button type="submit">Adicionar</button>
                </form>
                <ul class="item-list">
                <li>Item Exemplo <button class="delete-btn">Excluir</button></li>
                </ul>
            </div>

            
            <div class="grid-item">
                <h2>Bloco 4</h2>
                <form>
                <input type="text" placeholder="Campo exemplo">
                <button type="submit">Adicionar</button>
                </form>
                <ul class="item-list">
                <li>Item Exemplo <button class="delete-btn">Excluir</button></li>
                </ul>
            </div>  -->

            </div>
        </div>
    </section>
</main>
</body>
<script src="/public/js/main.js"></script>
<script src="/public/js/adicionarconteudo.js"></script>
</html>