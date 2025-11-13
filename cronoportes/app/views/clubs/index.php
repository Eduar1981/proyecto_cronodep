<?php
$titulo = 'Listado de clubs';
?>
<section>
    <h2>Clubs</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($clubs)): ?>
            <tr><td colspan="4">No hay clubs registrados.</td></tr>
        <?php else: ?>
            <?php foreach ($clubs as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['nombre_club']) ?></td>
                    <td><?= htmlspecialchars($club['correo_contacto']) ?></td>
                    <td><?= htmlspecialchars($club['telefono_contacto']) ?></td>
                    <td><?= htmlspecialchars($club['estado']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
