<?php

require_once __DIR__ . '/../config/bootstrap.php'; 
require_once __DIR__ . '/../controllers/WorkerController.php'; 

$controller = new WorkerController();
$workers = $controller->listWorker();

if (!empty($workers)): 
    foreach ($workers as $worker): ?>
        <div class="Worker">
            <div class="optWorker"><?php echo htmlspecialchars($worker['name']); ?> | <?php echo htmlspecialchars($worker['position']); ?></div>
            <div class="optWorker"><?php echo htmlspecialchars($worker['cpf']); ?></div>
            <div class="optWorker"><?php echo htmlspecialchars($worker['nameProject']); ?> | <?php echo htmlspecialchars($worker['timeProject']); ?></div>
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
    <?php endforeach;
else: ?>
    <p>Nenhum funcionário encontrado.</p>
<?php endif; ?>
