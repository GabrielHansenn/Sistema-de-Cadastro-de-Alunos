<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    header('Location: index.php');
    exit;
}

require_once 'CadastroAlunos.php';
$cadastro = new CadastroAlunos();

// Processa o formulário de cadastro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
        $aluno = new Aluno($_POST['nome'], $_POST['matricula'], $_POST['curso']);
        if ($cadastro->cadastrarAluno($aluno)) {
            $mensagem = "Aluno cadastrado com sucesso!";
            $tipo = "success";
        } else {
            $mensagem = "Erro ao cadastrar aluno. Matrícula pode já existir.";
            $tipo = "danger";
        }
    }
}

// Busca a lista de alunos
$alunos = $cadastro->listarAlunos();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Cadastro de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema de Alunos</a>
            <div class="navbar-nav ms-auto">
                <a href="logout.php" class="nav-link">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($mensagem)): ?>
            <div class="alert alert-<?php echo $tipo; ?> alert-dismissible fade show">
                <?php echo $mensagem; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Botão para abrir modal de cadastro -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCadastro">
            <i class="fas fa-plus"></i> Novo Aluno
        </button>

        <!-- Tabela de alunos -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Alunos Cadastrados</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Matrícula</th>
                                <th>Curso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos as $aluno): ?>
                                <tr>
                                    <td><?php echo $aluno->getId(); ?></td>
                                    <td><?php echo htmlspecialchars($aluno->getNome()); ?></td>
                                    <td><?php echo htmlspecialchars($aluno->getMatricula()); ?></td>
                                    <td><?php echo htmlspecialchars($aluno->getCurso()); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Cadastro -->
    <div class="modal fade" id="modalCadastro" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar Novo Aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="acao" value="cadastrar">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="matricula" class="form-label">Matrícula</label>
                            <input type="text" class="form-control" id="matricula" name="matricula" required>
                        </div>
                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <input type="text" class="form-control" id="curso" name="curso" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
