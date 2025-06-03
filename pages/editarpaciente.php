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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php 
    require_once __DIR__ . '/../config/bootstrap.php';
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../utils/nav.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        if (isset($_POST['form_type'])) {
            switch ($_POST['form_type']) {
                case 'registerUser':
                    var_dump($_POST);
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
            <div class="container">
                <form action="" method="post" id="multi-step-form">
                    <input type="hidden" name="form_type" value="registerUser">
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
                        <textarea name="situation"></textarea>
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
                        <input name="doctor" type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Inicio Tratamento</label>
                        <input name="startDateTreatment" type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Retorno Tratamento</label>
                        <input name="returnDateTreatment" type="text">
                        </div>
                        <div class="form-group">
                        <label>Data Intervalo Tratamento</label>
                        <input name="interval" type="text">
                        </div>
                        <div class="form-group">
                        <label>Ultima Consulta</label>
                        <input name="lastConsult" type="text">
                        </div>
                        <div class="form-group">
                        <label>Remedios</label>
                        <input name="medicines" type="text">
                        </div>
                        <div class="form-group">
                        <label>Monitoramento Psiquico</label>
                        <input name="monitoringPsycho" type="text">
                        </div>
                        <div class="form-title">
                            <h3>Moradia</h3>
                        </div>
                        <div class="form-group">
                        <label>Situação</label>
                        <input name="situation" type="text">
                        </div>
                        <div class="form-group">
                        <label>Terreno</label>
                        <input name="land" type="text">
                        </div>
                        <div class="form-group">
                        <label>Quartos</label>
                        <input name="rooms" type="text">
                        </div>
                        <div class="form-group">
                        <label>Higiene</label>
                        <input name="hygiene" type="text">
                        </div>
                        <div class="form-group">
                        <label>Construção</label>
                        <input name="construction" type="text">
                        </div>
                        <div class="form-group">
                        <label>Cobertura</label>
                        <input name="roof" type="text">
                        </div>
                        <div class="form-group">
                        <label>Piso</label>
                        <input name="floor" type="text">
                        </div>
                        <div class="form-group">
                        <label>Energia Elétrica</label>
                        <input name="energy" type="text">
                        </div>
                        <div class="form-group">
                        <label>Abastecimento de Água</label>
                        <input name="water" type="text">
                        </div>
                        <div class="form-group">
                        <label>Coleta de lixo</label>
                        <input name="trash" type="text">
                        </div>
                        <div class="form-group">
                        <label>Sistema de Esgoto</label>
                        <input name="sewage" type="text">
                        </div>
                        <div class="form-group">
                        <label>Pavimentação</label>
                        <input name="paving" type="text">
                        </div>
                        <div class="form-group">
                        <label>Iluminação Pública</label>
                        <input name="publiclight" type="text">
                        </div>
                        <div class="form-title">
                            <h3>Vulnerabilidade</h3>
                        </div>
                        <div class="form-group">
                        <label>Forma de Acesso</label>
                        <input name="accessForm" type="text">
                        </div>
                        <div class="form-group">
                        <label>Situação</label>
                        <input name="situation" type="text">
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
                    <h2>Afiliados, Beneficios, Despesas, Família</h2>
                    <div class="main-multi">
                        <!-- Seção de Benefícios -->
                        <div class="form-section" id="beneficios">
                            <div class="form-header">
                                <h2>Benefícios</h2>
                                <button type="button" class="add-btn" data-target="beneficios-form">Adicionar Benefício</button>
                            </div>
                            <div class="form-content" id="beneficios-form">
                                <div class="form-multi">
                                    <label for="beneficio-tipo">Tipo de Benefício</label>
                                    <input type="text" id="beneficio-tipo" name="beneficio_tipo_temp" placeholder="Ex: Vale Alimentação">
                                </div>
                                <div class="form-multi">
                                    <label for="beneficio-valor">Valor (R$)</label>
                                    <input type="number" id="beneficio-valor" name="beneficio_valor_temp" placeholder="Ex: 150.00" step="0.01">
                                </div>
                                <button type="button" class="submit-btn" id="add-beneficio">Adicionar à Lista</button>
                            </div>
                            <div class="items-list" id="beneficios-list"></div>
                        </div>

                        <!-- Seção de Despesas -->
                        <div class="form-section" id="despesas">
                            <div class="form-header">
                                <h2>Despesas</h2>
                                <button type="button" class="add-btn" data-target="despesas-form">Adicionar Despesa</button>
                            </div>
                            <div class="form-content" id="despesas-form">
                                <div class="form-multi">
                                    <label for="despesa-descricao">Descrição</label>
                                    <input type="text" id="despesa-descricao" name="despesa_descricao_temp" placeholder="Ex: Aluguel">
                                </div>
                                <div class="form-multi">
                                    <label for="despesa-valor">Valor (R$)</label>
                                    <input type="number" id="despesa-valor" name="despesa_valor_temp" placeholder="Ex: 1200.00" step="0.01">
                                </div>
                                <button type="button" class="submit-btn" id="add-despesa">Adicionar à Lista</button>
                            </div>
                            <div class="items-list" id="despesas-list"></div>
                        </div>

                        <!-- Seção de Afiliação -->
                        <div class="form-section" id="afiliacao">
                            <div class="form-header">
                                <h2>Afiliação</h2>
                                <button type="button" class="add-btn" data-target="afiliacao-form">Adicionar Afiliação</button>
                            </div>
                            <div class="form-content" id="afiliacao-form">
                                <div class="form-multi">
                                    <label for="afiliacao-entidade">Entidade</label>
                                    <input type="text" id="afiliacao-entidade" name="afiliacao_entidade_temp" placeholder="Ex: Sindicato dos Trabalhadores">
                                </div>
                                <div class="form-multi">
                                    <label for="afiliacao-data">Data de Início</label>
                                    <input type="date" id="afiliacao-data" name="afiliacao_data_temp">
                                </div>
                                <button type="button" class="submit-btn" id="add-afiliacao">Adicionar à Lista</button>
                            </div>
                            <div class="items-list" id="afiliacao-list"></div>
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