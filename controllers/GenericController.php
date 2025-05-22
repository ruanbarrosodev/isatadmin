<?php
use Isatadmin\Database;

class GenericModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllProjects(): array
    {
        $stmt = $this->pdo->query("SELECT idProject, projectName, projectTime FROM Project where projectName!='Projeto Dev' and projectName!='Projeto Admin'");
        return $stmt->fetchAll();
    }
}

class GenericController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new GenericModel($pdo);
    }

    public function listProject(): array
    {
        return $this->model->getAllProjects();
    }
}

