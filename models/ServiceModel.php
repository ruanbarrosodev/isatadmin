<?php

class ServiceModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getServices(): ?array
    {
        $sql = "SELECT * from Service";

        $stmt = $this->pdo->prepare($sql);
        //$stmt->execute([':cpf' => $cpf]);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
