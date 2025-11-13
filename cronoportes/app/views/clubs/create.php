<?php
$titulo = 'Registrar club';
?>
<section class="form-card">
    <h2>Nuevo club</h2>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars(route('clubs')) ?>" class="form-grid">
        <div class="form-group">
            <label for="nombre_club">Nombre *</label>
            <input type="text" id="nombre_club" name="nombre_club" value="<?= htmlspecialchars($data['nombre_club']) ?>" required>
            <?php if (!empty($errors['nombre_club'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['nombre_club']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="correo_contacto">Correo de contacto</label>
            <input type="email" id="correo_contacto" name="correo_contacto" value="<?= htmlspecialchars($data['correo_contacto']) ?>">
            <?php if (!empty($errors['correo_contacto'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['correo_contacto']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="telefono_contacto">Teléfono</label>
            <input type="text" id="telefono_contacto" name="telefono_contacto" value="<?= htmlspecialchars($data['telefono_contacto']) ?>">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($data['direccion']) ?>">
        </div>

        <div class="form-group">
            <label for="estado">Estado *</label>
            <select id="estado" name="estado">
                <option value="activo" <?= $data['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= $data['estado'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="documento_operador">Documento del operador</label>
            <input type="text" id="documento_operador" name="documento_operador" value="<?= htmlspecialchars($data['documento_operador']) ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">Guardar</button>
            <a class="btn btn-secondary" href="<?= htmlspecialchars(route('clubs')) ?>">Cancelar</a>
        </div>
    </form>
</section>
