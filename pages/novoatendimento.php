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
    <link type="text/css" rel="stylesheet" href="/public/css/novoatendimento.css">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.ico">
    <?php 
    require_once __DIR__ . '/../config/bootstrap.php';
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../utils/nav.php';
    require_once __DIR__ . '/../controllers/UserController.php';
    $response = null; 
    $controllerUser = new UserController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        if (isset($_POST['form_type'])) {
            switch ($_POST['form_type']) {
                case 'registerUserAndService':
                    if($_POST['typeService']=='cadastro novo' || $_POST['typeService']=='atualizacao de cadastro'){
                        $response = $controllerUser->registerUserAndService($_POST);
                        var_dump($response);
                        //header('Location: /editarpaciente');
                    }else{
                        $response = $controllerUser->registerUserAndService($_POST);
                    }
                    break;
                // Se tiver outros formulários na mesma página, adiciona outros cases aqui.
            }
        }
    }

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
           <form method="POST" class="form-atendimento">
                <input type="hidden" name="form_type" value="registerUserAndService">
                <h2>Formulário de Atendimento</h2>
                    <?php if (!is_null($response)): ?>
                        <div class="form-message <?php echo $response['success'] ? 'sucesso' : 'erro'; ?>">
                            <?php echo htmlspecialchars($response['message']); ?>
                        </div>
                    <?php endif; ?>
                <div class="form-group">
                    <label for="tipoAtendimento">Tipo de Atendimento</label>
                    <select id="tipoAtendimento" name="typeService">
                        <option value="cadastro novo">CADASTRO NOVO</option>
                        <option value="atualizacao de cadastro">ATUALIZAÇÃO DE CADASTRO</option>
                        <option value="encaminhamento">ENCAMINHAMENTO</option>
                        <option value="escuta qualificada">ESCUTA QUALIFICADA</option>
                        <option value="prientacao psicossocial">ORIENTAÇÃO PSICOSSOCIAL</option>
                        <option value="oficina de criatividade">OFICINA DE CRIATIVIDADE</option>
                        <option value="higiene mental e lazer">HIGIENE MENTAL E LAZER</option>
                        <option value="contato telefonico">CONTATO TELEFÔNICO</option>
                        <option value="atendimento em grupo">ATENDIMENTO EM GRUPO</option>
                        <option value="roda de conversa">RODA DE CONVERSA</option>
                        <option value="acolhida coletiva">ACOLHIDA COLETIVA</option>
                        <option value="beneficios eventuais">BENEFÍCIOS EVENTUAIS</option>
                        <option value="escuta orientacao psicologica">ESCUTA/ORIENTAÇÃO PSICOLÓGICA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="name" placeholder="Nome da pessoa">
                </div>

                <div class="form-group">
                    <label>Documento</label>
                    <div class="radio-group">
                    <label><input type="radio" name="tipoDocumento" value="cpf" checked> CPF</label>
                    <label><input type="radio" name="tipoDocumento" value="rg"> RG</label>
                    </div>
                    <input type="text" id="documento" name="cpf" placeholder="Digite o CPF">
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descriptionService" rows="4" placeholder="Descreva o atendimento..."></textarea>
                </div>

                <button type="submit" class="btn-submit">Enviar</button>
            </form>
        </div>
    </section>
</main>
</body>
<script src="public/js/novoatendimento.js"></script>
<script src="public/js/main.js"></script>
</html>