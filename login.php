<?php
// login.php
session_start();
require 'conexao.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Anti-pattern de segurança: MD5. Usado apenas por obrigatoriedade acadêmica.
    $senha_md5 = md5($senha);

    $stmt = $pdo->prepare("SELECT id, usuario FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->execute([$usuario, $senha_md5]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario'] = $user['usuario'];
        header("Location: index.php");
        exit;
    } else {
        $erro = "Credenciais inválidas.";
    }
}

require 'layout.php';
?>
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h5>Autenticação do Sistema</h5>
            </div>
            <div class="card-body">
                <?php if ($erro): ?>
                    <div class="alert alert-danger text-center"><?php echo $erro; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Usuário</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>