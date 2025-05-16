<?php
namespace Src;

use PDO;

/**
 * Classe para CRUD da tabela `contact`
 */
class ContactModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // CREATE
    public function create(string $name, string $email): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO contact (name, email) VALUES (:name, :email)");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email
        ]);
    }

    // READ - retorna todos os contatos
    public function read(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM contact");
        return $stmt->fetchAll();
    }

    // UPDATE - atualiza email pelo id
    public function update(int $id, string $email): bool
    {
        $stmt = $this->pdo->prepare("UPDATE contact SET email = :email WHERE id = :id");
        return $stmt->execute([
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // DELETE - remove contato pelo id
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM contact WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
