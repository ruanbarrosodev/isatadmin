<?php
require_once __DIR__ . '/../models/FeedbackModel.php';

use Isatadmin\Database;

class FeedbackController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new FeedbackModel($pdo);
    }

    public function listFeedback(): array
    {
        return $this->model->getAll();
    }
    public function deleteFeedback(int $id): array
    {
    $success = $this->model->deleteFeedback($id);
    return $success
        ? [
            'success' => true,
            'message' => 'Feedback deletado com sucesso.'
        ]
        : [
            'success' => false,
            'message' => 'Erro ao deletar feedback.'
        ];
    } 
}
