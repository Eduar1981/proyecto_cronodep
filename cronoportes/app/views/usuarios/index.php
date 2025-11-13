<?php
$titulo = 'Listado de usuarios';
?>
<section>
    <h2>Usuarios</h2>
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
                    <td><a class="btn" href="<?= htmlspecialchars(($GLOBALS['baseUrl'] ?? '') . '/usuarios/' . $usuario['id_usuario']) ?>">Ver</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
