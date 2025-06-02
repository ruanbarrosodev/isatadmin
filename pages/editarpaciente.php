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
    <link type="text/css" rel="stylesheet" href="/public/css/editarpaciente.css">
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
            <div class="container">
                <form id="multi-step-form">
                    <div class="form-step active">
                    <h2>Novo/Edição de Usuário</h2>
                    <div class="form-grid">
                        <div class="form-title">
                            <h3>Paciente</h3>
                        </div>
                        <div class="form-group">
                        <label>Nome Completo</label>
                        <input name="name" type="text">
                        </div>
                        <div class="form-group">
                        <label>RG</label>
                        <input name="rg" type="text">
                        </div>
                        <div class="form-group">
                        <label>CPF</label>
                        <input name="cpf" type="text">
                        </div>
                        <div class="form-group">
                        <label>Ano de Nascimento</label>
                        <input type="bornDate">
                        </div>
                        <div class="form-group">
                        <label>Cor</label>
                        <input name="race" type="text">
                        </div>
                        <div class="form-group">
                        <label>Status Civil</label>
                        <input name="civil status" type="text">
                        </div>
                        <div class="form-group">
                        <label>Educação</label>
                        <input name="education" type="text">
                        </div>
                        <div class="form-group">
                        <label>Nacionalidade</label>
                        <input name="nationality" type="text">
                        </div>
                        <div class="form-group">
                        <label>Telefone</label>
                        <input name="tel" type="situation">
                        </div>
                        <div class="form-group">
                        <label>Religião</label>
                        <input name="religion" type="text">
                        </div>
                        <div class="form-group">
                        <label>SUS Cartão</label>
                        <input name="suscard" type="text">
                        </div>
                        <div class="form-group">
                        <label>NIS/PIS</label>
                        <input name="nispis" type="text">
                        </div>
                        <div class="form-group">
                        <label>Profissão</label>
                        <input name="profession" type="text">
                        </div>
                        <div class="form-group">
                        <label>Situação</label>
                        <textarea></textarea>
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-title">
                            <h3>Endereço</h3>
                        </div>
                        <div class="form-group">
                        <label>Bairro</label>
                        <input name="district" type="text">
                        </div>
                        <div class="form-group">
                        <label>Rua</label>
                        <input name="street" type="text">
                        </div>
                        <div class="form-group">
                        <label>Zona</label>
                        <input name="zone" type="text">
                        </div>
                    </div>
                    <div class="form-nav">
                        <div></div>
                        <button type="button" class="next">Next</button>
                    </div>
                    </div>

                    <div class="form-step">
                    <h2>Saúde e bem estar</h2>
                    <div class="form-grid">
                        <div class="form-title">
                            <h3>Saúde</h3>
                        </div>
                        <div class="form-group">
                        <label>Suspeita</label>
                        <input name="suspect" type="text">
                        </div>
                        <div class="form-group">
                        <label>Hospital</label>
                        <input name="hospital" type="text">
                        </div>
                        <div class="form-group">
                        <label>Doutor</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Inicio Tratamento</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Retorno Tratamento</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Intervalo Tratamento</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Ultima Consulta</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Remedios</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Monitoramento Psiquico</label>
                        <input type="text">
                        </div>
                        <div class="form-title">
                            <h3>Moradia</h3>
                        </div>
                        <div class="form-group">
                        <label>Situação</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Terreno</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Quartos</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Higiene</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Construção</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Cobertura</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Piso</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Energia Elétrica</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Abastecimento de Água</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Coleta de lixo</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Sistema de Esgoto</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Pavimentação</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Iluminação Pública</label>
                        <input type="text">
                        </div>
                        <div class="form-title">
                            <h3>Vulnerabilidade</h3>
                        </div>
                        <div class="form-group">
                        <label>Forma de Acesso</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Situação</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Campo Hidden</label>
                        <textarea name="secrecy"></textarea>
                        </div>
                    </div>
                    <div class="form-nav">
                        <button type="button" class="prev">Back</button>
                        <button type="button" class="next">Next</button>
                    </div>
                    </div>

                    <div class="form-step">
                    <h2>Parentes, Afiliados, etc</h2>
                    <div class="form-grid">
                        <div class="form-group">
                        <label>Beneficios</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Despesas</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Afiliados</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>Family</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>NODESC</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>NODESC</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>NODESC</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>NODESC</label>
                        <input type="text">
                        </div>
                        <div class="form-group">
                        <label>NODESC</label>
                        <textarea></textarea>
                        </div>
                    </div>
                    <div class="form-nav">
                        <button type="button" class="prev">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
<script src="public/js/editarpaciente.js"></script>
<script src="public/js/main.js"></script>
</html>