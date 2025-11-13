<?php
$title = 'Panel Superadmin';
$usuario = $usuario ?? [];
$usuarios = $usuarios ?? [];
$clubs = $clubs ?? [];
?>
<section class="dashboard">
    <h2>Hola, <?= htmlspecialchars($usuario['nombre'] ?? 'Superadmin') ?></h2>
    <p class="help-text">Gestiona la plataforma y supervisa la operación de todos los clubes.</p>
    <div class="dashboard-grid">
        <article class="card">
            <h3>Clubs activos</h3>
            <p><?= count($clubs) ?></p>
        </article>
        <article class="card">
            <h3>Usuarios registrados</h3>
            <p><?= count($usuarios) ?></p>
        </article>
    </div>
</section>
<section>
    <div class="section-header">
        <h2>Usuarios recientes</h2>
        <a class="btn" href="<?= htmlspecialchars(route('/usuarios')) ?>">Gestionar usuarios</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($usuarios)): ?>
            <tr><td colspan="3">No hay usuarios registrados.</td></tr>
        <?php else: ?>
            <?php foreach (array_slice($usuarios, 0, 5) as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nombres'] . ' ' . $item['apellidos']) ?></td>
                    <td><?= htmlspecialchars($item['rol']) ?></td>
                    <td><?= htmlspecialchars($item['correo']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<section>
    <div class="section-header">
        <h2>Clubs registrados</h2>
        <a class="btn" href="<?= htmlspecialchars(route('/clubs')) ?>">Ver listado completo</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($clubs)): ?>
            <tr><td colspan="3">No hay clubs registrados.</td></tr>
        <?php else: ?>
            <?php foreach ($clubs as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['nombre_club']) ?></td>
                    <td><?= htmlspecialchars($club['correo_contacto'] ?? 'N/D') ?></td>
                    <td><?= htmlspecialchars($club['telefono_contacto'] ?? 'N/D') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
