<?php
$title = 'Panel Administrador';
$usuario = $usuario ?? [];
$usuarios = $usuarios ?? [];
$clubs = $clubs ?? [];
$clubActual = null;
$clubId = $usuario['id_club'] ?? null;
if ($clubId) {
    foreach ($clubs as $club) {
        if ((int) $club['id_club'] === (int) $clubId) {
            $clubActual = $club;
            break;
        }
    }
}
$usuariosClub = array_filter($usuarios, static function ($item) use ($clubId) {
    return (int) ($item['id_club'] ?? 0) === (int) $clubId;
});
?>
<section class="dashboard">
    <h2>Hola, <?= htmlspecialchars($usuario['nombre'] ?? 'Administrador') ?></h2>
    <p class="help-text">Desde aquí puedes gestionar a tu equipo y mantener actualizado tu club.</p>
    <div class="dashboard-grid">
        <article class="card">
            <h3>Mi club</h3>
            <p><?= htmlspecialchars($clubActual['nombre_club'] ?? 'Sin club asignado') ?></p>
        </article>
        <article class="card">
            <h3>Usuarios del club</h3>
            <p><?= count($usuariosClub) ?></p>
        </article>
    </div>
</section>
<section>
    <div class="section-header">
        <h2>Equipo activo</h2>
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
        <?php if (empty($usuariosClub)): ?>
            <tr><td colspan="3">No hay usuarios asignados a tu club.</td></tr>
        <?php else: ?>
            <?php foreach ($usuariosClub as $item): ?>
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
