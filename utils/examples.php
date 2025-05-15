<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=seubanco;charset=utf8", "usuario", "senha");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>

<?php
//2 create
$name = "João";
$email = "joao@email.com";

$stmt = $pdo->prepare("INSERT INTO contact (name, email) VALUES (:name, :email)");
$stmt->execute([
    ':name' => $name,
    ':email' => $email
]);
?>

<?php
//read
$stmt = $pdo->query("SELECT * FROM contact");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($contacts as $contact) {
    echo "Nome: " . $contact['name'] . " - Email: " . $contact['email'] . "<br>";
}
?>

<?php
//update
$newEmail = "novo@email.com";
$id = 1;

$stmt = $pdo->prepare("UPDATE contact SET email = :email WHERE id = :id");
$stmt->execute([
    ':email' => $newEmail,
    ':id' => $id
]);
?>

<?php
//delete
$id = 1;

$stmt = $pdo->prepare("DELETE FROM contact WHERE id = :id");
$stmt->execute([':id' => $id]);
?>

<?php 
$stmt = $pdo->prepare("INSERT INTO contact (name, email) VALUES (:name, :email)");
$stmt->execute([':name' => $nome, ':email' => $email]);

?>

