<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: /'); 
        exit;
    }
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = '/isatadmin/';
    $uri = str_starts_with($uri, $base) ? substr($uri, strlen($base)) : $uri;
    $uri = trim($uri, '/');
    $parts = explode('/', $uri);
    $idUser = (int)end($parts); 
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
    require_once __DIR__ . '/../controllers/UserController.php';

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        if (isset($_POST['form_type'])) {
            switch ($_POST['form_type']) {
                case 'registerUser':
                    var_dump($_POST);
                    break;
                case 'getIdByCPF':
                    $controller = new UserController();
                    $response = $controller->findUserIdByCpf($_POST['cpf']);
                    if($response['success']==true){
                        $idUser = $response['idUser'];
                        header("Location: editarpaciente/".$idUser);
                    }else{
                        $errocpf = $response['message'];
                    }
                    break;
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
                <?php 
                    if(!empty($idUser)){
                ?>
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
                    
                    <div class="form-nav">
                        <button type="button" class="prev">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                    </div>
                </form>
                <?php 
                }else{ 
                ?>
                <div id="cpfModal" class="modal-overlay">
                    <div class="modal-content">
                        <h2>Inserir CPF</h2>
                        <form method="POST" action="">
                        <input type="hidden" value="getIdByCPF" name="form_type">
                        <input type="text" name="cpf" placeholder="Digite o CPF" required>
                        <button type="submit">Buscar</button>

                        <?php if (isset($errocpf)): ?>
                            <p class="error-message"><?= htmlspecialchars($errocpf) ?></p>
                        <?php endif; ?>
                        </form>
                    </div>
                </div>
                <style>
                    .modal-overlay {
                    position: fixed;
                    top: 0; left: 0;
                    width: 100vw; height: 100vh;
                    background-color: rgba(0, 0, 0, 0.6); /* fundo escuro semi-transparente */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    }

                    .modal-content {
                    background: #fff;
                    padding: 2rem;
                    border-radius: 1rem;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                    width: 90%;
                    max-width: 400px;
                    text-align: center;
                    }

                    .modal-content h2 {
                    margin-bottom: 1rem;
                    font-size: 1.5rem;
                    }

                    .modal-content input {
                    width: 100%;
                    padding: 0.75rem;
                    margin: 0.5rem 0;
                    border: 1px solid #ccc;
                    border-radius: 0.5rem;
                    font-size: 1rem;
                    }

                    .modal-content button {
                    background: #4CAF50;
                    color: white;
                    border: none;
                    padding: 0.75rem 1.5rem;
                    border-radius: 0.5rem;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: background 0.3s;
                    }

                    .modal-content button:hover {
                    background: #45a049;
                    }

                    .error-message {
                    margin-top: 0.5rem;
                    color: #e74c3c;
                    font-size: 0.9rem;
                    }
                </style>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<script src="/public/js/editarpaciente.js"></script>
<script src="/public/js/main.js"></script>
</body>
</html>