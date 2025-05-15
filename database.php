<?php
$host = 'localhost';
$db   = 'agencia_viajes';
$user = 'postgres';     // usuario por defecto de PostgreSQL
$pass = '6194'; // cambiá esto por la que tengas configurada
$port = '5432';          // puerto por defecto de PostgreSQL

try {
  $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}
?>
