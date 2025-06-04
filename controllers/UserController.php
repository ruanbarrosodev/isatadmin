<?php

require_once __DIR__ . '/../models/UserModel.php';

use Isatadmin\Database;

class UserController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new UserModel($pdo);
    }

    public function registerUserAndService(array $data): array
    {
        // Campos obrigatórios
        $requiredFields = ['name', 'typeService', 'descriptionService'];

        // Verifica campos obrigatórios
        foreach ($requiredFields as $field) {
            if (empty(trim($data[$field] ?? ''))) {
                return ['success' => false, 'message' => "O campo '$field' é obrigatório."];
            }
        }

        // Sanitização
        $cleanData = [];
        foreach ($data as $key => $value) {
            $cleanData[$key] = strip_tags(trim($value));
        }

        // Obtém CPF e RG se existirem, senão nulo
        $cpf = $cleanData['cpf'] ?? null;
        $rg = $cleanData['rg'] ?? null;

        // Chama o model para inserir
        $success = $this->model->newService(
            $cleanData['name'],
            $cpf,
            $rg,
            $cleanData['typeService'],
            $cleanData['descriptionService']
        );

        return $success
            ? ['success' => true, 'message' => 'Usuário e serviço cadastrados com sucesso!']
            : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }
    public function listUsers(){
        return $this->model->getUsers();
    }
    public function findUserIdByCpf(string $cpf): array
    {
        $id = $this->model->getUserIdByCpf($cpf);

        if ($id) {
            return ['success' => true, 'idUser' => $id];
        } else {
            return ['success' => false, 'message' => 'Usuário não encontrado.'];
        }
    }

}
