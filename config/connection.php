<?php 
require_once __DIR__ . '/bootstrap.php';

$host = getenv('DB1_HOST');
$user = getenv('DB1_USER');
$pass = getenv('DB1_PASS');
$dbname = getenv('DB1_NAME');

echo "HOST: $host\n";
echo "USER: $user\n";
echo "PASS: $pass\n";
echo "DB: $dbname\n";

    
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}


/*
// Se quiser usar a segunda conexão (comente/descomente quando precisar)
try {
    $pdo2 = new PDO(
        "mysql:host=" . getenv('DB2_HOST') . ";dbname=" . getenv('DB2_NAME') . ";charset=" . getenv('DB2_CHARSET'),
        getenv('DB2_USER'),
        getenv('DB2_PASS')
    );
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão DB2: " . $e->getMessage();
    exit;
}
*/

?>