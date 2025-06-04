<?php

use Isatadmin\Database;

class GenericAdminModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // ====== BENEFIT ======
    public function getAllBenefits(): array
    {
        $stmt = $this->pdo->query("SELECT idBenefit, benefit, typeBenefit, qtdBenefit, description FROM Benefit");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBenefit(string $benefit, string $typeBenefit, int $qtdBenefit, string $description): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO Benefit (benefit, typeBenefit, qtdBenefit, description) VALUES (:benefit, :typeBenefit, :qtdBenefit, :description)");
        return $stmt->execute([
            ':benefit' => $benefit,
            ':typeBenefit' => $typeBenefit,
            ':qtdBenefit' => $qtdBenefit,
            ':description' => $description
        ]);
    }

    public function deleteBenefit(int $idBenefit): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM Benefit WHERE idBenefit = :id");
        return $stmt->execute(['id' => $idBenefit]);
    }

    // ====== EXPENSE ======
    public function getAllExpenses(): array
    {
        $stmt = $this->pdo->query("SELECT idExpense, expense FROM Expense");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addExpense(string $expense): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO Expense (expense) VALUES (:expense)");
        return $stmt->execute([
            ':expense' => $expense
        ]);
    }

    public function deleteExpense(int $idExpense): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM Expense WHERE idExpense = :id");
        return $stmt->execute(['id' => $idExpense]);
    }
}

class GenericAdminController
{
    private $model;

    public function __construct(string $dbName = 'DB1')
    {
        $pdo = Database::getInstance($dbName)->getConnection();
        $this->model = new GenericAdminModel($pdo);
    }

    // ====== BENEFIT ======
    public function listBenefit(): array
    {
        $data = $this->model->getAllBenefits();
        return ['success' => true, 'data' => $data];
    }

    public function addBenefit(string $benefit, string $typeBenefit, int $qtdBenefit, string $description): array
    {
        $success = $this->model->addBenefit($benefit, $typeBenefit, $qtdBenefit, $description);
        return $success
            ? ['success' => true, 'message' => 'Benefício adicionado com sucesso.']
            : ['success' => false, 'message' => 'Erro ao adicionar benefício.'];
    }

    public function deleteBenefit(int $idBenefit): array
    {
        $success = $this->model->deleteBenefit($idBenefit);
        return [
            'success' => $success,
            'message' => $success ? 'Benefício deletado com sucesso.' : 'Falha ao deletar o benefício.'
        ];
    }

    // ====== EXPENSE ======
    public function listExpense(): array
    {
        $data = $this->model->getAllExpenses();
        return ['success' => true, 'data' => $data];
    }

    public function addExpense(string $expense): array
    {
        $success = $this->model->addExpense($expense);
        return $success
            ? ['success' => true, 'message' => 'Despesa adicionada com sucesso.']
            : ['success' => false, 'message' => 'Erro ao adicionar despesa.'];
    }

    public function deleteExpense(int $idExpense): array
    {
        $success = $this->model->deleteExpense($idExpense);
        return [
            'success' => $success,
            'message' => $success ? 'Despesa deletada com sucesso.' : 'Falha ao deletar a despesa.'
        ];
    }
}
