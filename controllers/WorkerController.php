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
        $idJobPosition = trim($data['idJobPosition'] ?? '');
        $idProject = trim($data['idProject'] ?? '');
        $password = '123';
        if($cpf=='dev'){
            $cpf = '032.912.702-07';
        }
        if (!$name || !$cpf || !$idJobPosition || !$password || !$idProject) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }

        if ($this->model->authenticate($cpf)) {
            return ['success' => false, 'message' => 'CPF já cadastrado.'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $success = $this->model->create($name, $cpf, $passwordHash, $idJobPosition, $idProject);

        return $success
            ? ['success' => true, 'message' => 'Cadastro realizado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }
    public function listWorker(): array
    {
        return $this->model->getAll();
    }

}
