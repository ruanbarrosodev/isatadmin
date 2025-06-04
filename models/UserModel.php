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
            // Prepara as variáveis padrão com valores vazios
            $defaultData = [
                'district' => '',
                'street' => '',
                'zone' => '',
                'housingSituation' => '',
                'land' => '',
                'rooms' => '',
                'hygiene' => '',
                'construction' => '',
                'roof' => '',
                'floor' => '',
                'energy' => '',
                'water' => '',
                'trash' => '',
                'sewage' => '',
                'paving' => '',
                'publiclight' => '',
                'suspect' => '',
                'hospital' => '',
                'doctor' => '',
                'startDateTreatment' => '',
                'intervalDoctor' => '',
                'returnDateTreatment' => '',
                'lastConsult' => '',
                'medicines' => '',
                'monitoringPsycho' => '',
                'accessForm' => '',
                'vulnerabilitySituation' => '',
                'secrecy' => ''
            ];

            // Extrai as variáveis automaticamente
            extract($defaultData);
            // Inserir na tabela Address
                $sqlAddress = "INSERT INTO Address (
                                district,
                                street,
                                zone,
                                User_idUser
                            ) VALUES (
                                :district,
                                :street,
                                :zone,
                                :userId
                            )";

                $stmtAddress = $this->pdo->prepare($sqlAddress);
                $stmtAddress->execute([
                    ':district' => $district,
                    ':street' => $street,
                    ':zone' => $zone,
                    ':userId' => $userId
                ]);

                // Inserir na tabela Housing
                $sqlHousing = "INSERT INTO Housing (
                                situation,
                                land,
                                rooms,
                                hygiene,
                                construction,
                                roof,
                                floor,
                                energy,
                                water,
                                trash,
                                sewage,
                                paving,
                                publiclight,
                                User_idUser
                            ) VALUES (
                                :situation,
                                :land,
                                :rooms,
                                :hygiene,
                                :construction,
                                :roof,
                                :floor,
                                :energy,
                                :water,
                                :trash,
                                :sewage,
                                :paving,
                                :publiclight,
                                :userId
                            )";

                    $stmtHousing = $this->pdo->prepare($sqlHousing);
                    $stmtHousing->execute([
                        ':situation' => $housingSituation,
                        ':land' => $land,
                        ':rooms' => $rooms,
                        ':hygiene' => $hygiene,
                        ':construction' => $construction,
                        ':roof' => $roof,
                        ':floor' => $floor,
                        ':energy' => $energy,
                        ':water' => $water,
                        ':trash' => $trash,
                        ':sewage' => $sewage,
                        ':paving' => $paving,
                        ':publiclight' => $publiclight,
                        ':userId' => $userId
                    ]);

                    // Inserir na tabela Health
                    $sqlHealth = "INSERT INTO Health (
                            suspect,
                            hospital,
                            doctor,
                            startDateTreatment,
                            intervalDoctor,
                            returnDateTreatment,
                            lastConsult,
                            medicines,
                            monitoringPsycho,
                            User_idUser
                        ) VALUES (
                            :suspect,
                            :hospital,
                            :doctor,
                            :startDateTreatment,
                            :intervalDoctor,
                            :returnDateTreatment,
                            :lastConsult,
                            :medicines,
                            :monitoringPsycho,
                            :userId
                        )";

                    $stmtHealth = $this->pdo->prepare($sqlHealth);
                    $stmtHealth->execute([
                        ':suspect' => $suspect,
                        ':hospital' => $hospital,
                        ':doctor' => $doctor,
                        ':startDateTreatment' => $startDateTreatment,
                        ':intervalDoctor' => $intervalDoctor,
                        ':returnDateTreatment' => $returnDateTreatment,
                        ':lastConsult' => $lastConsult,
                        ':medicines' => $medicines,
                        ':monitoringPsycho' => $monitoringPsycho,
                        ':userId' => $userId
                    ]);

                    // Inserir na tabela Vulnerability
                    $sqlVulnerability = "INSERT INTO Vulnerability (
                            accessForm,
                            situation,
                            secrecy,
                            User_idUser
                        ) VALUES (
                            :accessForm,
                            :situation,
                            :secrecy,
                            :userId
                        )";

                    $stmtVulnerability = $this->pdo->prepare($sqlVulnerability);
                    $stmtVulnerability->execute([
                        ':accessForm' => $accessForm,
                        ':situation' => $vulnerabilitySituation,
                        ':secrecy' => $secrecy,
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
    
    public function getUserIdByCpf(string $cpf): ?int
    {
        $sql = "SELECT idUser FROM User WHERE cpf = :cpf LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? (int)$result['idUser'] : null;
    }

}
