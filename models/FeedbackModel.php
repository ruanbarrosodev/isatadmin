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
        $stmt = $this->pdo->query("SELECT name, email, contact, description, created_at FROM wp04_feedbacks ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
