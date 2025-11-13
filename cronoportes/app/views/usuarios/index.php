<?php
$titulo = 'Listado de usuarios';
?>
<section>
    <div class="section-header">
        <h2>Usuarios</h2>
        <a class="btn" href="<?= htmlspecialchars(route('usuarios/crear')) ?>">Registrar usuario</a>
    </div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Club</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($usuarios)): ?>
            <tr><td colspan="6">No hay usuarios registrados.</td></tr>
        <?php else: ?>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></td>
                    <td><?= htmlspecialchars($usuario['documento']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_club'] ?? 'Sin club') ?></td>
                    <td><a class="btn btn-small" href="<?= htmlspecialchars(route('usuarios/' . $usuario['id_usuario'])) ?>">Ver</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
