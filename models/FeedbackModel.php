<?php

class FeedbackModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT id, name, email, contact, description, created_at FROM wp04_feedbacks ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    public function deleteFeedback(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM wp04_feedbacks 
             WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
