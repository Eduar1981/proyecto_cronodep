<?php
$titulo = 'Panel principal';
?>
<section class="dashboard">
    <h2>Resumen general</h2>
    <div class="dashboard-grid">
        <article class="card">
            <h3>Total de usuarios</h3>
            <p><?= count($usuarios) ?></p>
        </article>
        <article class="card">
            <h3>Total de clubs</h3>
            <p><?= count($clubs) ?></p>
        </article>
    </div>
</section>
<section>
    <h2>Usuarios recientes</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Rol</th>
                <th>Club</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($usuarios)): ?>
            <tr><td colspan="4">No hay usuarios registrados.</td></tr>
        <?php else: ?>
            <?php foreach (array_slice($usuarios, 0, 5) as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></td>
                    <td><?= htmlspecialchars($usuario['documento']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_club'] ?? 'Sin club') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
