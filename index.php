<?php
// index.php
// Framework escolhido: Bootstrap 5
// Importado em layout.php via https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require 'conexao.php';
require 'layout.php'; // Inclui navbar e Bootstrap

// Framework utilizado: Bootstrap 5
// Importado no arquivo layout.php

$stmt = $pdo->prepare("SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY status DESC, id DESC");
$stmt->execute([$_SESSION['usuario_id']]);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Painel de Tarefas</h2>
    <a href="nova.php" class="btn btn-primary shadow-sm">+ Nova Tarefa</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle m-0">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th class="text-center">Status</th>
                        <th>Data de Criação</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $t): ?>
                        <tr>
                            <td class="fw-medium"><?php echo htmlspecialchars($t['titulo']); ?></td>
                            <td class="text-center">
                                <?php if ($t['status'] === 'concluida'): ?>
                                    <span class="badge bg-success">Concluída</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($t['data_criacao'])); ?></td>
                            <td class="text-end">
                                <a href="editar.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <a href="concluir.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-success">Concluir</a>
                                <a href="excluir.php?id=<?php echo $t['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma a exclusão dessa tarefa?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($tarefas)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Nenhuma tarefa registrada.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>