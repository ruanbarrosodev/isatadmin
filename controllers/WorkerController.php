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
        if (!$name || !$cpf || !$idJobPosition || !$password || !$idProject) {
            return ['success' => false, 'message' => 'Todos os campos são obrigatórios.'];
        }

        if ($this->model->getByCpf($cpf)) {
            return ['success' => false, 'message' => 'CPF já cadastrado.'];
        }   

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $dateEntry = date('Y-m-d');

        $success = $this->model->create($name, $cpf, $passwordHash,$dateEntry, $idJobPosition, $idProject);

        return $success
            ? ['success' => true, 'message' => 'Cadastro realizado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }

    public function authenticate(string $cpf, string $password): array
    {
        $user = $this->model->getByCpf($cpf);

        if (!$user) {
            return ['success' => false, 'message' => 'Usuário não encontrado.'];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Senha incorreta.'];
        }

        return ['success' => true, 'message' => 'Login realizado com sucesso.', 'user' => $user];
    }

    public function listWorker(): array
    {
        return $this->model->getAll();
    }
    public function resetPassword($id): array
    {
        if (!$id) {
            return ['success' => false, 'message' => 'ID do funcionário é obrigatório para resetar a senha.'];
        }

        $success = $this->model->resetPassword($id);

        return $success
            ? ['success' => true, 'message' => 'Senha resetada com sucesso.']
            : ['success' => false, 'message' => 'Erro ao resetar a senha.'];
    }

    public function deleteWorker($id): array
    {
        if (!$id) {
            return ['success' => false, 'message' => 'ID do funcionário é obrigatório para desativa-lo.'];
        }

        $success = $this->model->deleteWorker($id);

        return $success
            ? ['success' => true, 'message' => 'Funcionário excluído com sucesso.']
            : ['success' => false, 'message' => 'Erro ao excluir o funcionário.'];
    }
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Limpa todas as variáveis de sessão
        $_SESSION = [];

        // Destroi a sessão
        session_destroy();

        // Opcional: redireciona pra página de login ou inicial
        header('Location: /');
        exit;
    }



}
