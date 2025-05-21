<?php
require_once __DIR__ . '/../models/WorkerModel.php';

use Isatadmin\Database;

class WorkerController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new WorkerModel($pdo);
    }

    public function register(array $data): array
    {
        $name = trim($data['name'] ?? '');
        $cpf = trim($data['cpf'] ?? '');
        $position = trim($data['position'] ?? '');
        $projectName = trim($data['projectName'] ?? '');
        $projectTime = trim($data['projectTime'] ?? '');
        $password = '123';
        $projectId = '3';
        $projectTime = 'eterno';
        if (!$name || !$cpf || !$position || !$password || !$projectName || !$projectTime) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }

        if ($this->model->authenticate($cpf)) {
            return ['success' => false, 'message' => 'CPF já cadastrado.'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $success = $this->model->create($name, $cpf, $position, $passwordHash, $projectId, $projectTime);

        return $success
            ? ['success' => true, 'message' => 'Cadastro realizado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }
    public function listWorker(): array
    {
        return $this->model->getAll();
    }

}
