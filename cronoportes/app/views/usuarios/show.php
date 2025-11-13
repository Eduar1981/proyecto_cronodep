<?php
$titulo = 'Detalle de usuario';
?>
<section>
    <h2><?= htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></h2>
    <dl class="detail-list">
        <dt>Documento</dt>
        <dd><?= htmlspecialchars($usuario['documento']) ?></dd>
        <dt>Correo</dt>
        <dd><?= htmlspecialchars($usuario['correo']) ?></dd>
        <dt>Rol</dt>
        <dd><?= htmlspecialchars($usuario['rol']) ?></dd>
        <dt>Club</dt>
        <dd><?= htmlspecialchars($usuario['nombre_club'] ?? 'Sin club') ?></dd>
        <dt>Estado</dt>
        <dd><?= htmlspecialchars($usuario['estado']) ?></dd>
        <dt>Fecha de registro</dt>
        <dd><?= htmlspecialchars($usuario['fecha_registro']) ?></dd>
    </dl>
    <a class="btn" href="<?= htmlspecialchars(route('usuarios')) ?>">Volver al listado</a>
</section>
