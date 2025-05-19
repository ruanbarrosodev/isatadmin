<?php
namespace Isatadmin;

use PDO;
use PDOException;

class Database
{
    private static ?Database $db1Instance = null;
    private static ?Database $db2Instance = null;

    private ?PDO $connection = null;

    private function __construct(string $dbIdentifier)
    {
        $host = $_ENV["{$dbIdentifier}_HOST"] ?? getenv("{$dbIdentifier}_HOST");
        $user = $_ENV["{$dbIdentifier}_USER"] ?? getenv("{$dbIdentifier}_USER");
        $pass = $_ENV["{$dbIdentifier}_PASS"] ?? getenv("{$dbIdentifier}_PASS");
        $dbname = $_ENV["{$dbIdentifier}_NAME"] ?? getenv("{$dbIdentifier}_NAME");
        $charset = $_ENV["{$dbIdentifier}_CHARSET"] ?? 'utf8';

        try {
            $this->connection = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $user,
                $pass
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro na conexão com {$dbIdentifier}: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(string $db = 'DB1'): Database
    {
        if ($db === 'DB1') {
            if (self::$db1Instance === null) {
                self::$db1Instance = new Database('DB1');
            }
            return self::$db1Instance;
        }

        if ($db === 'DB2') {
            if (self::$db2Instance === null) {
                self::$db2Instance = new Database('DB2');
            }
            return self::$db2Instance;
        }

        throw new \InvalidArgumentException("Banco inválido: use 'DB1' ou 'DB2'");
    }

    public function getConnection(): ?PDO
    {
        return $this->connection;
    }

    private function __clone() {}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
