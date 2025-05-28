<?php

class WorkerModel
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function newService(string $name,string $gender,string $bornDate,int $age,string $nationality,string $rg,string $cpf,string $education,string $tel,string $profession,string $civilStatus,string $religion,string $nispis,string $suscad,string $situation,string $typeService,string $descriptionService): bool {
    // Inicia uma transação para garantir que ambas as inserções ocorram com sucesso
    $this->pdo->beginTransaction();
    try {
        // 1. Inserir na tabela User
        $sqlUser = "INSERT INTO User (
                        signedUp, 
                        dateSigned, 
                        name, 
                        gender, 
                        bornDate, 
                        age, 
                        nationality, 
                        rg, 
                        cpf, 
                        education, 
                        tel, 
                        profession, 
                        civilStatus, 
                        religion, 
                        nispis, 
                        suscard, 
                        situation, 
                        Worker_idWorker
                    ) VALUES (
                        false, 
                        CURDATE(), 
                        :name, 
                        :gender, 
                        :bornDate, 
                        :age, 
                        :nationality, 
                        :rg, 
                        :cpf, 
                        :education, 
                        :tel, 
                        :profession, 
                        :civilStatus, 
                        :religion, 
                        :nispis, 
                        :suscad, 
                        :situation, 
                        :Worker_idWorker
                    )";
        
        $stmtUser = $this->pdo->prepare($sqlUser);
        $stmtUser->execute([
            ':name' => $name,
            ':gender' => $gender,
            ':bornDate' => $bornDate,
            ':age' => $age,
            ':nationality' => $nationality,
            ':rg' => $rg,
            ':cpf' => $cpf,
            ':education' => $education,
            ':tel' => $tel,
            ':profession' => $profession,
            ':civilStatus' => $civilStatus,
            ':religion' => $religion,
            ':nispis' => $nispis,
            ':suscad' => $suscad,
            ':situation' => $situation,
            ':Worker_idWorker' => $_SESSION['idWorker']
        ]);

        $userId = $this->pdo->lastInsertId();


        $sqlService = "INSERT INTO Service (
                           type, 
                           dateService, 
                           description,
                           User_idUser
                       ) VALUES (
                           :type, 
                           CURDATE(), 
                           :description, 
                           :userId
                       )";
        
        $stmtService = $this->pdo->prepare($sqlService);
        $stmtService->execute([
            ':type' => $typeService,
            ':description' => $descriptionService,
            ':userId' => $userId
        ]);

        // Confirma a transação
        $this->pdo->commit();
        return true;
        } catch (PDOException $e) {
            // Em caso de erro, desfaz a transação
            $this->pdo->rollBack();
            error_log("Erro ao inserir usuário e serviço: " . $e->getMessage());
            return false;
        }
    }
}
