
<!DOCTYPE html>
<?php
session_start();
$_SESSION['worker'] = 'Ruan';
if (!isset($_SESSION['worker'])) {
    header('Location: /'); 
    exit;
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISAT </title>
    <link type="text/css" rel="stylesheet" href="/public/css/main.css">
    <link type="text/css" rel="stylesheet" href="/public/css/gerenciar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php 
    require_once __DIR__ . '/../config/bootstrap.php';
    require_once __DIR__ . '/../utils/menu.php';
    require_once __DIR__ . '/../utils/nav.php';
    require_once __DIR__ . '/../controllers/WorkerController.php';
    require_once __DIR__ . '/../controllers/GenericController.php';
    $controller = new WorkerController();
    $workers = $controller->listWorker();
    $response = null; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        if (isset($_POST['form_type'])) {
            switch ($_POST['form_type']) {
                case 'signUpWorker':     
                    $controller = new WorkerController();
                    $response = $controller->register($_POST);
                break;
                case 'form2':
                    $controller2 = new Controller2();
                    $response2 = $controller2->handle($_POST);
                    break;
            }
        }
    }
    $controller = new GenericController();
    $projects = $controller->listProject();
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
            <h2 class="tituloPage">Painel Funcionários</h2>
                <div class="tabs">
                    <div class="tab-btn active" data-tab="1">Novo Funcionário</div>
                    <div class="tab-btn" data-tab="2">Funcionários</div>
                    <div class="tab-btn" data-tab="3">Projetos</div>
                </div>
                <div class="tab-content active" data-tab="1">
                    <h3>Novo Funcionário</h3>
                    <?php if (!is_null($response)): ?>
                        <div class="form-message <?php echo $response['success'] ? 'sucesso' : 'erro'; ?>">
                            <?php echo htmlspecialchars($response['message']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="gerenciar">
                        <form class="formNewWorker" method="POST" action="">
                            <input type="hidden" name="form_type" value="signUpWorker">
                            <!-- <h4>Novo Funcionário</h4> -->
                            <div class="optNewWorker">
                                <label>Nome</label>
                                <input type="text" name="name" required>
                            </div>
                            <div class="optNewWorker">
                                <label>CPF</label>
                                <input type="text" name="cpf" placeholder="000.000.000-00" maxlength="14">
                            </div>
                            <!-- <div class="optNewWorker">
                                <label>Cargo</label>
                                <input type="text">
                            </div> -->
                            <div class="optNewWorker">
                                <label>Cargos</label>
                                <select class="optNewWorker" name="position" required>
                                    <option value="">Selecione</option>
                                    <option value="Assistente Social">Assistente Social</option>
                                    <option value="Psicologa">Psicologa</option>
                                    <option value="Atendente">Atendente</option>
                                </select>
                            </div>
                            <div class="optNewWorker">
                                <label>Projeto</label>
                                <select class="optNewWorker" name="idProject" required>
                                    <option value="">Selecione</option>
                                    <?php if(!empty($projects)): ?>
                                        <?php foreach($projects as $project): ?>      
                                            <option value="<?=$project['idProject']?>"><?=$project['projectName']?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="optNewWorker">
                                <input type="submit" value="Cadastrar">
                            </div>
                        </form>
                    </div>    
                </div>                    
                <div class="tab-content" data-tab="2">
                    <h3>Funcionários</h3>
                    <form class="formNewWorker" method="POST" action="">
                            <div class="optNewWorker">
                                <label>Projeto</label>
                                <select class="optNewWorker" name="projectName" required>
                                    <option value="">Selecione</option>
                                        <?php if(!empty($projects)): ?>
                                            <?php foreach($projects as $project): ?>      
                                                <option value="<?=$project['idProject']?>"><?=$project['projectName']?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                </select>
                            </div>
                            <!-- <div class="optNewWorker">
                                <input type="submit" value="Pesquisar">
                            </div> -->
                        </form>
                        <?php if (!empty($workers)): ?>
                            <?php foreach ($workers as $worker): ?>
                                <div class="Worker">
                                    <div class="optWorker"><?php echo htmlspecialchars($worker['name']); ?> | <?php echo htmlspecialchars($worker['position']); ?></div>
                                    <div class="optWorker"><?php echo htmlspecialchars($worker['cpf']); ?></div>
                                    <div class="optWorker"><?php echo htmlspecialchars($worker['projectName']) ?> | <?php echo htmlspecialchars($worker['projectTime']) ?></div>
                                    <form class="formWorkerOpt">
                                        <div class="optWorker btnDeleteWorker" data-modal-id="<?php echo $worker['idWorker']; ?>">Deletar Funcionário</div>
                                        <div class="optWorker btnChangePassword" data-modal-id="<?php echo $worker['idWorker']; ?>">Resetar senha</div>

                                        <div class="modal modal-<?php echo $worker['idWorker']; ?>">
                                            <div class="modalBody bodyDelete-<?php echo $worker['idWorker']; ?>">
                                                <p>Você deseja deletar este funcionário "<?php echo htmlspecialchars($worker['name']); ?>"?</p>
                                                <div class="buttonsFormWorker">
                                                    <button>SIM</button>
                                                    <button>CANCELAR</button>
                                                </div>
                                            </div>
                                            <div class="modalBody bodyReset-<?php echo $worker['idWorker']; ?>">
                                                <p>Você deseja resetar a senha deste funcionário "<?php echo htmlspecialchars($worker['name']); ?>"?</p>
                                                <div class="buttonsFormWorker">
                                                    <button>SIM</button>
                                                    <button>CANCELAR</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </div>
            <div class="tab-content" data-tab="3">
                <h3>Projetos</h3>
                <div class="cards-container">
                    <!-- Card Projetos -->
                    <div class="card">
                        <h4>Projetos</h4>
                        <form class="form-add">
                            <input type="text" name="projectName" placeholder="Novo Projeto">
                            <select class="optNewWorker" name="projectTime" required>
                                <option value="">Selecione</option>
                                <option>3 meses</option>
                                <option>6 meses</option>
                                <option>1 ano</option>
                                <option>2 anos</option>
                            </select>
                            <button type="submit">Adicionar</button>
                        </form>
                        <div class="list">
                            <?php if(!empty($projects)): ?>
                                <?php foreach($projects as $project): ?>    
                                        <div class="item">
                                            <span><?=$project['projectName']?> - <?=$project['projectTime']?></span>
                                            <form method="post" action="" class="form-delete">
                                                <input type="hidden" value="<?=$project['idProject']?>">
                                                <button type="submit">Deletar</button>
                                            </form>
                                        </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Card Cargos -->
                    <div class="card">
                        <h4>Cargos</h4>
                        <form class="form-add">
                            <input type="text" name="positionName" placeholder="Novo Cargo" required>
                            <button type="submit">Adicionar</button>
                        </form>
                        <div class="list">
                            <div class="item">
                                <span>Gerente</span>
                                <form class="form-delete">
                                    <button type="submit">Deletar</button>
                                </form>
                            </div>
                            <div class="item">
                                <span>Assistente</span>
                                <form class="form-delete">
                                    <button type="submit">Deletar</button>
                                </form>
                            </div>
                            <!-- + Outras repetições -->
                        </div>
                    </div>
                </div>
            </div>

  
        </div>
    </section>
</main>
</body>
<script src="public/js/main.js"></script>
<script src="../public/js/gerenciar.js"></script>
</html>