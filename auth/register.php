<?php
require '../config/db.php';

if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senha, $telefone])) {
        header("Location: login.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"
        integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="box">
                <h2>Cadastro</h2>

                <?php if (isset($erro)) echo "<div class='alert alert-danger' role='alert'>$erro</div>"; ?>

                <form method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="nome" placeholder="Nome completo" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <div class="mb-4">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>

                    <div class="mb-4">
                        <input type="tel" class="form-control" name="telefone" placeholder="Telefone" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Cadastrar</button>
                    </div>
                </form>

                <p class="form-text mt-3 text-center">Já tem conta? <a href="login.php" class="link-secondary">Entrar</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"
        integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>