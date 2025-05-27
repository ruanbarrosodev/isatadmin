<?php 
    require_once __DIR__ . '/./utils/menu.php';
    require_once __DIR__ . '/./utils/nav.php';
    require_once __DIR__ . '/./config/bootstrap.php';
    session_start();
    //var_dump($_SESSION);
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
    <title>ISAT </title>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
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
            <div>EXEMPLO</div>
        </div>
    </section>
</main>
</body>
<script src="public/js/main.js"></script>
</html>