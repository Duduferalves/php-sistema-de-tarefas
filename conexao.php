<?php
// conexao.php
$host = 'localhost';
$db   = 'tarefas';
$user = 'root'; 
$pass = 'ceub123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Modo de erro essencial para debugar falhas no PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro fatal de conexão: " . $e->getMessage());
}
?>