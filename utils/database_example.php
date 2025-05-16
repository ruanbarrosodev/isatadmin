<?php
namespace Isatadmin;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $connection = null;

    private function __construct()
    {
        $host = $_ENV['DB1_HOST'] ?? getenv('DB1_HOST');
        $user = $_ENV['DB1_USER'] ?? getenv('DB1_USER');
        $pass = $_ENV['DB1_PASS'] ?? getenv('DB1_PASS');
        $dbname = $_ENV['DB1_NAME'] ?? getenv('DB1_NAME');

        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    private function __clone() { }
    private function __wakeup() { }
}
