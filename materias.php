<?php
require 'auth/auth.php';
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['materia'], $_FILES['arquivo'])) {
        $nomeMateria = $_POST['materia'];
        $data = $_POST['data'];
        $arquivo = $_FILES['arquivo'];

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeUnico = uniqid('arquivo_', true) . '.' . $extensao;
        $caminhoArquivo = 'uploads/' . $nomeUnico;

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            $stmt = $pdo->prepare("INSERT INTO materias (usuario_id, nome, data, arquivo) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['usuario_id'], $nomeMateria, $data, $caminhoArquivo]);
        }
    }
}

$materias = $pdo->prepare("SELECT * FROM materias WHERE usuario_id = ?");
$materias->execute([$_SESSION['usuario_id']]);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Minhas Matérias</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"
        integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container py-5">
        <h4 class="text-center mb-4" style="color: #606C38;">
            Bem-vindo, <?= ($_SESSION['nome']) ?> |
            <a class="logout-link ms-2" href="logout.php">Sair</a>
        </h4>

        <div class="row justify-content-center">
            <!-- Formulário -->
            <div class="col-md-6 mb-4">
                <div style="background: var(--cor-terciaria);" class="p-4 border rounded shadow-sm">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="data" class="form-label t-p">Data</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="mb-3">
                            <label for="materia" class="form-label t-p">Nome da Matéria</label>
                            <input type="text" class="form-control" id="materia" name="materia"
                                placeholder="Ex: Matemática" required>
                        </div>
                        <div class="mb-3">
                            <label for="arquivo" class="form-label t-p">Arquivo</label>
                            <input type="file" class="form-control" id="arquivo" name="arquivo" required>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Adicionar</button>
                    </form>
                </div>
            </div>

            <!-- Lista de matérias -->
            <div class="col-md-6">
                <div style="background: var(--cor-terciaria);" class="p-4 border rounded shadow-sm">
                    <h5 class="t-p mb-3">Minhas Matérias</h5>
                    <?php if ($materias->rowCount() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Matéria</th>
                                        <th>Arquivo</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($materias as $m): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($m['data']) ?></td>
                                            <td><?= htmlspecialchars($m['nome']) ?></td>
                                            <td><a href="<?= htmlspecialchars($m['arquivo']) ?>" target="_blank">📄 Ver</a></td>
                                            <td class="text-center">
                                                <a href="editar_materia.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                                <a href="excluir_materia.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta matéria?');">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Nenhuma matéria adicionada ainda.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"
        integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>