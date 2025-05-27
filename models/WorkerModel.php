<?php

class WorkerModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(string $name, string $cpf, string $passwordHash, string $dateEntry, int $idJobPosition, int $idProject): bool
    {
        $sql = "INSERT INTO Worker (name, cpf, password, dateEntry, JobPosition_idJobPosition, Project_idProject) 
                VALUES (:name, :cpf, :password, :dateEntry, :idJobPosition, :idProject)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':cpf' => $cpf,
            ':password' => $passwordHash,
            ':dateEntry' => $dateEntry,
            ':idJobPosition' => $idJobPosition,
            ':idProject' => $idProject
            ]);
    }

    public function getByCpf(string $cpf): ?array
    {
        $sql = "SELECT w.*, pos.namePosition AS position, p.nameProject 
                FROM Worker w
                JOIN Project p ON w.Project_idProject = p.idProject
                JOIN JobPosition pos ON w.JobPosition_idJobPosition = pos.idJobPosition
                WHERE w.cpf = :cpf AND w.active = 1
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function getAll(int|null $idProject = null): array
    {
        $sql = "SELECT w.idWorker, w.name, w.cpf, pos.namePosition AS position, 
                    p.nameProject, p.timeProject
                FROM Worker w
                JOIN Project p ON w.Project_idProject = p.idProject
                JOIN JobPosition pos ON w.JobPosition_idJobPosition = pos.idJobPosition 
                WHERE w.name != 'Dev' AND w.name != 'Admin' AND w.active = 1";

        $params = [];

        if (!empty($idProject)) {
            $sql .= " AND p.idProject = :idProject";
            $params[':idProject'] = $idProject;
        }

        $sql .= " ORDER BY w.idWorker DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    public function resetPassword($id): bool
    {
        $newPassword = password_hash('123', PASSWORD_DEFAULT);
        $sql = "UPDATE Worker SET password = :password WHERE idWorker = :idWorker";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':password' => $newPassword,
            ':idWorker' => $id
        ]);
    }

    public function deleteWorker($id): bool
    {
        $sql = "UPDATE Worker SET active = 0 WHERE idWorker = :idWorker";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':idWorker' => $id]);
    }

}
