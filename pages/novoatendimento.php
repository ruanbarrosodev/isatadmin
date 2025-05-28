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
           <form class="form-atendimento">
                <h2>Formulário de Atendimento</h2>

                <div class="form-group">
                    <label for="tipoAtendimento">Tipo de Atendimento</label>
                    <select id="tipoAtendimento" name="tipoAtendimento">
                        <option value="cadastronovo">CADASTRO NOVO</option>
                        <option value="atualizacaodecadastro">ATUALIZAÇÃO DE CADASTRO</option>
                        <option value="encaminhamento">ENCAMINHAMENTO</option>
                        <option value="escutaqualificada">ESCUTA QUALIFICADA</option>
                        <option value="orientacaopsicossocial">ORIENTAÇÃO PSICOSSOCIAL</option>
                        <option value="oficinadecriatividade">OFICINA DE CRIATIVIDADE</option>
                        <option value="higienementalela">HIGIENE MENTAL E LAZER</option>
                        <option value="contatotelefonico">CONTATO TELEFÔNICO</option>
                        <option value="atendimentoemgrupo">ATENDIMENTO EM GRUPO</option>
                        <option value="rodadeconversa">RODA DE CONVERSA</option>
                        <option value="acolhidacoletiva">ACOLHIDA COLETIVA</option>
                        <option value="beneficioseventuais">BENEFÍCIOS EVENTUAIS</option>
                        <option value="escutaorientacaopsicologica">ESCUTA/ORIENTAÇÃO PSICOLÓGICA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome da pessoa">
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
                    <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o atendimento..."></textarea>
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