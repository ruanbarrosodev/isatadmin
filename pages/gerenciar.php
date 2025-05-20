
<!DOCTYPE html>
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
                    <div class="gerenciar">
                        <form class="formNewWorker"> 
                          <!--   <h4>Novo Funcionário</h4> -->
                            <div class="optNewWorker">
                                <label>Nome</label>
                                <input type="text">
                            </div>
                            <div class="optNewWorker">
                                <label>CPF</label>
                                <input type="text">
                            </div>
                        <!--  <div class="optNewWorker">
                                <label>Cargo</label>
                                <input type="text">
                            </div> -->
                            <div class="optNewWorker">
                                <label>Posição</label>
                                <select class="optNewWorker">
                                    <option value="">Assistente Social</option>
                                    <option value="">Psicologa</option>
                                    <option value="">Atendente</option>
                                </select>
                            </div>
                             <div class="optNewWorker">
                                <label>Tempo</label>
                                <select class="optNewWorker">
                                    <option value="">1 ano</option>
                                    <option value="">6 meses</option>
                                    <option value="">2 anos</option>
                                </select>
                            </div>
                             <div class="optNewWorker">
                                <label>Projeto</label>
                                <select class="optNewWorker">
                                    <option value="">Projeto 1</option>
                                    <option value="">Projeto 2</option>
                                    <option value="">Projeto 3</option>
                                </select>
                            </div>
                            <div class="optNewWorker">
                                <input type="button" value="Cadastrar">
                            </div>
                        </form>
                    </div>    
                </div>                    
                <div class="tab-content" data-tab="2">
                    <h3>Funcionários</h3>
                        <div class="Worker">
                            <div class="optWorker">Katiana Ferreira | Assistente Social</div>
                            <div class="optWorker">324.235.451-05</div>
                            <form class="formWorkerOpt">
                                <div class="optWorker btnDeleteWorker" data-modal-id="1">Deletar Funcionário</div>
                                <div class="optWorker btnChangePassword" data-modal-id="1">Resetar senha</div>

                                <div class="modal modal-1">
                                    <div class="modalBody bodyDelete-1">
                                        <p> Você deseja deletar este funcionário "name1"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                    <div class="modalBody bodyReset-1">
                                        <p> Você deseja resetar a senha deste funcionário "name1"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="Worker">
                            <div class="optWorker">Katiana Ferreira | Assistente Social</div>
                            <div class="optWorker">324.235.451-05</div>
                            <form class="formWorkerOpt">
                                <div class="optWorker btnDeleteWorker" data-modal-id="2">Deletar Funcionário</div>
                                <div class="optWorker btnChangePassword" data-modal-id="2">Resetar senha</div>

                                <div class="modal modal-2">
                                    <div class="modalBody bodyDelete-2">
                                        <p> Você deseja deletar este funcionário "name2"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                    <div class="modalBody bodyReset-2">
                                        <p> Você deseja resetar a senha deste funcionário "name2"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="Worker">
                            <div class="optWorker">Katiana Ferreira | Assistente Social</div>
                            <div class="optWorker">324.235.451-05</div>
                            <form class="formWorkerOpt">
                                <div class="optWorker btnDeleteWorker" data-modal-id="3">Deletar Funcionário</div>
                                <div class="optWorker btnChangePassword" data-modal-id="3">Resetar senha</div>

                                <div class="modal modal-3">
                                    <div class="modalBody bodyDelete-3">
                                        <p> Você deseja deletar este funcionário "name3"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                    <div class="modalBody bodyReset-3">
                                        <p> Você deseja resetar a senha deste funcionário "name3"?</p>
                                        <div class="buttonsFormWorker">
                                            <button>SIM</button>
                                            <button>CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="tab-content" data-tab="3">
                    <h3>Projetos</h3>
                    <p>Lista</p>
                </div> 




            
        </div>
    </section>
</main>
</body>
<script src="public/js/main.js"></script>
<script src="../public/js/gerenciar.js"></script>
</html>