<?php
include 'database.php';

//$id = $_GET['id'];
//$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
//$stmt->execute([$id]);

//header("Location: index.php");
//exit;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);
    header("Location: usuarios.php");
    exit;
}
?>