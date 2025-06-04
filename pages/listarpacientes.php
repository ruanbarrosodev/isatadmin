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
    <link type="text/css" rel="stylesheet" href="/public/css/feedbacks.css">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <?php 
    require_once __DIR__ . '/../config/bootstrap.php';
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../utils/nav.php';
    require_once __DIR__ . '/../controllers/UserController.php';
    $controller = new UserController();
    $listUsers = $controller->listUsers();

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
            <?php 
            foreach($listUsers as $user){
                echo "<br>";
                echo "<br>";
                var_dump($user);
            }
            ?>
        </div>
    </section>
</main>
</body>
<script src="/public/js/main.js"></script>
</html>