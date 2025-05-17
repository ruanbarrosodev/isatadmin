<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISAT </title>
    <link type="text/css" rel="stylesheet" href="/public/css/main.css">
    <link type="text/css" rel="stylesheet" href="/public/css/feedbacks.css">
    <?php 
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../config/bootstrap.php';
    ?>
</head>
<body>
<header> 
    <nav>
        <div><p>ISAT - INICIO</p></div>
        <div><p>Katiana Ferreira - Assistente Social</p></div>
        <div><p>032.232.415-05</p></div>
        <div id="switchColor"><p>SWITCH</p></div>
        <div><p>SAIR</p></div>
    </nav>
</header>
<main>

    
    <section class="main-body">
        <?php 
            renderMenu($menuItems, $currentUri);
        ?>
        <div class="content">
            <div>EXEMPLO</div>
        </div>
    </section>
</main>
</body>
<script src="public/js/main.js"></script>
</html>