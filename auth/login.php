<?php
session_start();
require '../config/db.php';

if (isset($_POST['email'], $_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        header("Location: ../materias.php");
        exit();
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"
        integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="box">
                <h2>Login</h2>
                <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
                <form method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>

                    <div class="mb-4">
                        <input type="password" class="form-control" name="senha" placeholder="Senha" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Login</button>
                    </div>
                </form>
                <p class="form-text mt-3 text-center">Não tem uma conta? <a href="login.php" class="link-secondary">Cadastre-se</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"
        integrity="sha512-sH8JPhKJUeA9PWk3eOcOl8U+lfZTgtBXD41q6cO/slwxGHCxKcW45K4oPCUhHG7NMB4mbKEddVmPuTXtpbCbFA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>