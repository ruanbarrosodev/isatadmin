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
}
