<?php

require_once __DIR__ . '/../models/WorkerModel.php';

class WorkerController
{
    private WorkerModel $model;

    public function __construct(\PDO $pdo)
    {
        $this->model = new WorkerModel($pdo);
    }
    public function register(array $data): array
    {
        $name = trim($data['name'] ?? '');
        $cpf = trim($data['cpf'] ?? '');
        $position = trim($data['position'] ?? '');
        $password = $data['password'] ?? '';

        if (!$name || !$cpf || !$position || !$password) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }
        if ($this->model->findByCpf($cpf)) {
            return ['success' => false, 'message' => 'CPF já cadastrado.'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $success = $this->model->create($name, $cpf, $position, $passwordHash);

        return $success
            ? ['success' => true, 'message' => 'Cadastro realizado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }

    public function login(array $data): array
    {
        $cpf = trim($data['cpf'] ?? '');
        $password = $data['password'] ?? '';

        if (!$cpf || !$password) {
            return ['success' => false, 'message' => 'CPF e senha são obrigatórios.'];
        }

        $user = $this->model->findByCpf($cpf);

        if (!$user || !password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'CPF ou senha inválidos.'];
        }
        
        unset($user['password']);

        return [
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'user' => $user
        ];
    }
}
