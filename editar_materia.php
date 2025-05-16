<?php
require 'auth/auth.php';
require 'config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM materias WHERE id = ? AND usuario_id = ?");
$stmt->execute([$id, $_SESSION['usuario_id']]);
$materia = $stmt->fetch();

if (!$materia) {
    echo "Matéria não encontrada.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['materia'];
    $data = $_POST['data'];

    $stmt = $pdo->prepare("UPDATE materias SET nome = ?, data = ? WHERE id = ? AND usuario_id = ?");
    $stmt->execute([$nome, $data, $id, $_SESSION['usuario_id']]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Matéria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <h3 class="mb-4">Editar Matéria</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Data</label>
                <input type="date" name="data" class="form-control" value="<?= htmlspecialchars($materia['data']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nome da Matéria</label>
                <input type="text" name="materia" class="form-control" value="<?= htmlspecialchars($materia['nome']) ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>