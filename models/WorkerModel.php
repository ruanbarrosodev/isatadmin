<?php

class WorkerModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function create(string $name, string $cpf, string $position, string $passwordHash): bool
    {
        $sql = "INSERT INTO Worker (name, cpf, position, password) 
                VALUES (:name, :cpf, :position, :password)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':cpf' => $cpf,
            ':position' => $position,
            ':password' => $passwordHash
        ]);
    }

    public function findByCpf(string $cpf): ?array
    {
        $sql = "SELECT * FROM Worker WHERE cpf = :cpf LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
