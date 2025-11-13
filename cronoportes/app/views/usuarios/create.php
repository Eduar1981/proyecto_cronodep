<?php
$titulo = 'Registrar usuario';
?>
<section class="form-card">
    <h2>Nuevo usuario</h2>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars(route('usuarios')) ?>" class="form-grid">
        <div class="form-group">
            <label for="nombres">Nombres *</label>
            <input type="text" id="nombres" name="nombres" value="<?= htmlspecialchars($data['nombres']) ?>" required>
            <?php if (!empty($errors['nombres'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['nombres']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos *</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= htmlspecialchars($data['apellidos']) ?>" required>
            <?php if (!empty($errors['apellidos'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['apellidos']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="tipo_documento">Tipo de documento</label>
            <input type="text" id="tipo_documento" name="tipo_documento" value="<?= htmlspecialchars($data['tipo_documento']) ?>">
        </div>

        <div class="form-group">
            <label for="documento">Documento *</label>
            <input type="text" id="documento" name="documento" value="<?= htmlspecialchars($data['documento']) ?>" required>
            <?php if (!empty($errors['documento'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['documento']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="correo">Correo electrónico *</label>
            <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($data['correo']) ?>" required>
            <?php if (!empty($errors['correo'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['correo']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="clave">Clave *</label>
            <input type="password" id="clave" name="clave" required>
            <?php if (!empty($errors['clave'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['clave']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="rol">Rol *</label>
            <select id="rol" name="rol" required>
                <option value="">Selecciona un rol</option>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?= htmlspecialchars($rol) ?>" <?= $data['rol'] === $rol ? 'selected' : '' ?>><?= ucfirst($rol) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['rol'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['rol']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="id_club">Club</label>
            <select id="id_club" name="id_club">
                <option value="">Sin asignar</option>
                <?php foreach ($clubs as $club): ?>
                    <option value="<?= (int) $club['id_club'] ?>" <?= (string) $club['id_club'] === (string) $data['id_club'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($club['nombre_club']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($data['fecha_nacimiento']) ?>">
            <?php if (!empty($errors['fecha_nacimiento'])): ?>
                <small class="form-error"><?= htmlspecialchars($errors['fecha_nacimiento']) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="tipo_sangre">Tipo de sangre</label>
            <input type="text" id="tipo_sangre" name="tipo_sangre" value="<?= htmlspecialchars($data['tipo_sangre']) ?>">
        </div>

        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" value="<?= htmlspecialchars($data['celular']) ?>">
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
            <a class="btn btn-secondary" href="<?= htmlspecialchars(route('usuarios')) ?>">Cancelar</a>
        </div>
    </form>
</section>
