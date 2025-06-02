<?php

class UserModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function newService(string $name, ?string $cpf, ?string $rg, string $typeService, string $descriptionService): bool
    {
        $this->pdo->beginTransaction();

        try {
            // Inserir na tabela User
            $sqlUser = "INSERT INTO User (
                            name,
                            rg,
                            cpf,
                            Worker_idWorker
                        ) VALUES (
                            :name,
                            :rg,
                            :cpf,
                            :Worker_idWorker
                        )";

            $stmtUser = $this->pdo->prepare($sqlUser);
            $stmtUser->execute([
                ':name' => $name,
                ':rg' => $rg,
                ':cpf' => $cpf,
                ':Worker_idWorker' => $_SESSION['idWorker']
            ]);

            $userId = $this->pdo->lastInsertId();

            // Inserir na tabela Service
            $sqlService = "INSERT INTO Service (
                               type,
                               dateService,
                               description,
                               User_idUser
                           ) VALUES (
                               :type,
                               NOW(),
                               :description,
                               :userId
                           )";

            $stmtService = $this->pdo->prepare($sqlService);
            $stmtService->execute([
                ':type' => $typeService,
                ':description' => $descriptionService,
                ':userId' => $userId
            ]);

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Erro ao inserir usuário e serviço: " . $e->getMessage());
            return false;
        }
    }
    public function getUsers(){
        $sql = "SELECT * from User";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
