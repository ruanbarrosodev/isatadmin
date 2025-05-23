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
        $stmt = $this->pdo->query("SELECT idProject, nameProject, timeProject FROM Project WHERE nameProject != 'Projeto Dev' AND nameProject != 'Projeto Admin'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProject(string $name, string $time): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO Project (nameProject, timeProject) VALUES (:name, :time)");
        return $stmt->execute([
            ':name' => $name,
            ':time' => $time
        ]);
    }

     public function deleteProject(int $idProject): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM Project WHERE idProject = :id");
        return $stmt->execute(['id' => $idProject]);
    }


    public function getAllPositions(): array
    {
        $stmt = $this->pdo->query("SELECT idJobPosition, namePosition FROM JobPosition WHERE namePosition != 'Desenvolvedor' AND namePosition != 'Diretora'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPosition(string $name): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO JobPosition (namePosition) VALUES (:name)");
        return $stmt->execute([
            ':name' => $name
        ]);
    }
     public function deleteJobPosition(int $idJobPosition): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM JobPosition WHERE idJobPosition = :id");
        return $stmt->execute(['id' => $idJobPosition]);
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
        $data = $this->model->getAllProjects();
        return ['success' => true, 'data' => $data];
    }

    public function addProject(string $name, string $time): array
    {
        $success = $this->model->addProject($name, $time);
        return $success
            ? ['success' => true, 'message' => 'Projeto adicionado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao adicionar projeto.'];
    }

    public function deleteProject(int $idProject): array
    {
        $success = $this->model->deleteProject($idProject);
        return [
            'success' => $success,
            'message' => $success ? 'Projeto deletado com sucesso.' : 'Falha ao deletar o projeto.'
        ];
    }

    public function listPosition(): array
    {
        $data = $this->model->getAllPositions();
        return ['success' => true, 'data' => $data];
    }

    public function addPosition(string $name): array
    {
        $success = $this->model->addPosition($name);
        return $success
            ? ['success' => true, 'message' => 'Cargo adicionado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao adicionar cargo.'];
    }
    public function deleteJobPosition(int $idJobPosition): array
    {
        $success = $this->model->deleteJobPosition($idJobPosition);
        return [
            'success' => $success,
            'message' => $success ? 'Cargo deletado com sucesso.' : 'Falha ao deletar o cargo.'
        ];
    }
}
