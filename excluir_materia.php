<?php
require 'auth/auth.php';
require 'config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: materias.php');
    exit;
}

// Primeiro, pegamos o caminho do arquivo para excluir do servidor
$stmt = $pdo->prepare("SELECT arquivo FROM materias WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $_SESSION['usuario_id']]);
$materia = $stmt->fetch();

if ($materia) {
    if (file_exists($materia['arquivo'])) {
        unlink($materia['arquivo']); // Exclui o arquivo do servidor
    }

    $stmt = $pdo->prepare("DELETE FROM materias WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$id, $_SESSION['usuario_id']]);
}

header('Location: index.php');
exit;
