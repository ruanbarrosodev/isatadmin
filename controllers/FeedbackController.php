<?php
require_once __DIR__ . '/../models/FeedbackModel.php';

use Isatadmin\Database;

/*
      $pdo2 = \Isatadmin\Database::getInstance('DB2')->getConnection();
        $outroModel = new OutraModel($pdo2);
     */
    
class FeedbackController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new FeedbackModel($pdo);
    }

    public function index(): array
    {
        return $this->model->getAll();
    }
}
