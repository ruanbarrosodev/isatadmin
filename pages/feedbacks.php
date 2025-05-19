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
     require_once __DIR__ . '/../controllers/FeedbackController.php';

    $controller = new FeedbackController('DB2');
    $feedbacks = $controller->index();


    

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
            <div class="feedbacks">
                <h4>Feedbacks</h4>
                <?php if (empty($feedbacks)): ?>
                <p>Nenhum feedback encontrado.</p>
            <?php else: ?>
                <?php foreach ($feedbacks as $fb): ?>
                    <div class="feedback">
                        <p><b>Nome: </b><?= htmlspecialchars($fb['name']) ?><span><?= date('d/m/Y', strtotime($fb['created_at'])) ?></span></p>
                        <p><b>Email: </b><?= htmlspecialchars($fb['email']) ?></p>
                        <p><b>Contato: </b> <?= htmlspecialchars($fb['contact']) ?></p>
                        <p><b>Descrição: </b><?= nl2br(htmlspecialchars($fb['description'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>
</main>
</body>
<script src="public/js/main.js"></script>
</html>