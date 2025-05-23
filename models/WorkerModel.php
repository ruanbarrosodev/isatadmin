<?php

class WorkerModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, string $cpf, string $passwordHash, int $idJobPosition , int $idProject): bool
    {
        $sql = "INSERT INTO Worker (name, cpf, password, JobPosition_idJobPosition, Project_idProject) 
                VALUES (:name, :cpf, :password, :idJobPosition, :idProject)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':cpf' => $cpf,
            ':password' => $passwordHash,
            ':idJobPosition' => $idJobPosition,
            ':idProject' => $idProject
        ]);
    }

    public function authenticate(string $cpf): ?array
    {
        $sql = "SELECT * FROM Worker WHERE cpf = :cpf LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function getAll(): array
    {
        $sql = "SELECT w.idWorker, w.name, w.cpf, pos.namePosition AS position, 
                       p.nameProject, p.timeProject
                FROM Worker w
                JOIN Project p ON w.Project_idProject = p.idProject
                JOIN JobPosition pos ON w.JobPosition_idJobPosition = pos.idJobPosition 
                WHERE w.name != 'Dev' AND w.name != 'Admin'
                ORDER BY w.idWorker DESC
                LIMIT 5";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
