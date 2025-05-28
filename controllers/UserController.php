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
        // Campos obrigatórios (exceto os que podem ser nulos)
        /* $requiredFields = [
            'name', 'gender', 'bornDate', 'age', 'nationality', 
            'rg', 'cpf', 'education', 'tel', 'profession', 
            'civilStatus', 'religion', 'nispis', 'suscad', 'situation',
            'typeService', 'descriptionService'
        ];

        // Verifica campos obrigatórios
        foreach ($requiredFields as $field) {
            if (empty(trim($data[$field] ?? ''))) {
                return ['success' => false, 'message' => "O campo '$field' é obrigatório."];
            }
        } */

        // Sanitização básica (remove tags HTML e espaços extras)
        $cleanData = [];
        foreach ($data as $key => $value) {
            $cleanData[$key] = strip_tags(trim($value));
        }
        /* 
        // Validação de CPF (se já existe)
        if ($this->model->userExists($cleanData['cpf'])) {
            return ['success' => false, 'message' => 'CPF já cadastrado.'];
        } */

        /* // Validação de idade (exemplo: deve ser número)
        if (!is_numeric($cleanData['age'])) {
            return ['success' => false, 'message' => 'Idade deve ser um número.'];
        } */

        // Chama o model para inserir
        $success = $this->model->newUserAndService(
            $cleanData['name'],
            $cleanData['gender'],
            $cleanData['bornDate'],
            (int)$cleanData['age'],
            $cleanData['nationality'],
            $cleanData['rg'],
            $cleanData['cpf'],
            $cleanData['education'],
            $cleanData['tel'],
            $cleanData['profession'],
            $cleanData['civilStatus'],
            $cleanData['religion'],
            $cleanData['nispis'],
            $cleanData['suscad'],
            $cleanData['situation'],
            $cleanData['typeService'],
            $cleanData['descriptionService']
        );

        return $success ? ['success' => true, 'message' => 'Usuário e serviço cadastrados com sucesso!'] : ['success' => false, 'message' => 'Erro ao cadastrar.'];
    }
}