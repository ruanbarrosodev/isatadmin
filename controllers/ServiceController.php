<?php

require_once __DIR__ . '/../models/ServiceModel.php';

use Isatadmin\Database;

class ServiceController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new ServiceModel($pdo);
    }
    public function listService(): array
    {
        return $this->model->getServices();
    }

}
