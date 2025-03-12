<?php
session_start();
require_once 'User.php';

// Se já estiver logado, redireciona para o dashboard
if (isset($_SESSION['logado']) && $_SESSION['logado']) {
    header('Location: dashboard.php');
    exit;
}

// Processa o login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    if ($user->login($_POST['username'], $_POST['password'])) {
        $_SESSION['logado'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = "Usuário ou senha inválidos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Cadastro de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2 class="text-center mb-4">Sistema de Cadastro de Alunos</h2>
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="mt-3 text-center">
                <small class="text-muted">Usuário padrão: admin / Senha: admin123</small>
            </div>
        </div>
    </div>
</body>
</html>
