<?php
session_start();

require_once __DIR__ . '/config/bootstrap.php';
require_once __DIR__ . '/controllers/WorkerController.php';

if (isset($_SESSION['name'])) {
    header('Location: /home');
    exit;
}
$response = null;
$controllerWorker = new WorkerController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
        $cpf = trim($_POST['cpf'] ?? '');
        $password = $_POST['password'] ?? '';

        $response = $controllerWorker->authenticate($cpf, $password);

        if ($response['success']) {
            $_SESSION['name'] = $response['worker']['name'];
            $_SESSION['idWorker'] = $response['worker']['idWorker'];
            $_SESSION['cpf'] = $response['worker']['cpf'];
            $_SESSION['JobPosition'] = $response['worker']['position'];

            header('Location: /home');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ISAT - Bem vindo</title>
    <link type="text/css" rel="stylesheet" href="public/css/main.css">
    <link type="text/css" rel="stylesheet" href="public/css/login.css">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
</head>
<body>
    <header>
        <nav>
            <div>ISAT - Instituto Silvério de Almeida Tundis </div>
        </nav>
    </header>
    <section class="loginpage">
        <div class="info">
            <img src="public/img/girlphoto.png" alt="photogarota">
            <p>Criado em 2005, tem como missão defender os direitos de cidadania, de grupos socialmente excluídos e participar, na definição de Políticas Públicas para a Saúde Mental no Amazonas. O nome da instituição é uma homenagem à Silvério de Almeida Tundis, um psiquiatra amazonense que liderou o movimento de Reforma Psiquiátrica da região durante a década de 80, tendo sido o primeiro coordenador de Saúde Mental do estado. o ISAT desenvolve atividades terapêutico-pedagógicas para auxiliar no tratamento de pessoas em sofrimento psíquico. Visa também formar multiplicadores e promover mudanças na atenção em Saúde Mental. 
            <br>
            A Saúde Mental, segundo a OMS e o Ministério da Saúde, é definida como um estado de bem-estar que permite ao indivíduo utilizar suas habilidades, lidar com o estresse cotidiano, ser produtivo e contribuir para a comunidade. Sua definição envolve a interação de fatores biológicos, psicológicos e sociais, ou seja, possui características biopsicossociais.
            </p>
        </div>
        <div class="login">
            <h4>Entre no ISAT ADM</h4>
            <img src="public/img/logo.png" alt="logoisat">
            <?php if (!empty($response) && !$response['success']): ?>
                <div class="error-message" style="color:red; margin-bottom:1rem;">
                    <?= htmlspecialchars($response['message']) ?>
                </div>
            <?php endif; ?>
            <form method="post"> 
                <input type="hidden" name="form_type" value="login">
                <div class="partForm">
                    <label>CPF: </label>
                    <input name="cpf" id="cpf" type="text">
                </div>
                <div class="partForm">
                    <label>SENHA: </label>
                    <input name="password" type="password">
                </div>
                <div class="partForm">
                    <input type="submit" value="ENTRAR">
                </div>
            </form>
        </div>
    </section>
</body>
<script>
    /* document.getElementById('cpf').addEventListener('input', function (e) {
        let value = e.target.value;
        
        value = value.replace(/\D/g, '');

        value = value.substring(0, 11);

        if (value.length > 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
        } else if (value.length > 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
        } else if (value.length > 3) {
            value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
        }

        e.target.value = value;
    }); */
</script>
<script src="public/js/main.js"></script>
</html>