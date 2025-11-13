<?php
$title = 'Registrar primer club';
$data = $data ?? [];
$errors = $errors ?? [];
?>
<section class="auth-card">
    <h2>Registrar primer club</h2>
    <p class="help-text">Este formulario creará el primer club y un usuario con rol Superadmin.</p>
    <?php if (!empty($errors['general'])): ?>
        <p class="alert alert-error"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>
    <form method="post" action="<?= htmlspecialchars(route('/register-club')) ?>" class="form-grid">
        <fieldset>
            <legend>Datos del club</legend>
            <div class="form-control">
                <label for="nombre_club">Nombre del club</label>
                <input type="text" name="nombre_club" id="nombre_club" value="<?= htmlspecialchars($data['nombre_club'] ?? '') ?>" required>
                <?php if (!empty($errors['nombre_club'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['nombre_club']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="correo_contacto">Correo de contacto</label>
                <input type="email" name="correo_contacto" id="correo_contacto" value="<?= htmlspecialchars($data['correo_contacto'] ?? '') ?>">
                <?php if (!empty($errors['correo_contacto'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['correo_contacto']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="telefono_contacto">Teléfono de contacto</label>
                <input type="text" name="telefono_contacto" id="telefono_contacto" value="<?= htmlspecialchars($data['telefono_contacto'] ?? '') ?>">
            </div>
            <div class="form-control">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($data['direccion'] ?? '') ?>">
            </div>
            <div class="form-control">
                <label for="documento_operador">Documento del operador</label>
                <input type="text" name="documento_operador" id="documento_operador" value="<?= htmlspecialchars($data['documento_operador'] ?? '') ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>Usuario superadministrador</legend>
            <div class="form-control">
                <label for="nombres">Nombres</label>
                <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($data['nombres'] ?? '') ?>" required>
                <?php if (!empty($errors['nombres'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['nombres']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($data['apellidos'] ?? '') ?>" required>
                <?php if (!empty($errors['apellidos'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['apellidos']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="documento">Documento</label>
                <input type="text" name="documento" id="documento" value="<?= htmlspecialchars($data['documento'] ?? '') ?>" required>
                <?php if (!empty($errors['documento'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['documento']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="correo">Correo de acceso</label>
                <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($data['correo'] ?? '') ?>" required>
                <?php if (!empty($errors['correo'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['correo']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" required>
                <?php if (!empty($errors['clave'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['clave']) ?></small>
                <?php endif; ?>
            </div>
            <div class="form-control">
                <label for="confirmacion">Confirmar contraseña</label>
                <input type="password" name="confirmacion" id="confirmacion" required>
                <?php if (!empty($errors['confirmacion'])): ?>
                    <small class="error"><?= htmlspecialchars($errors['confirmacion']) ?></small>
                <?php endif; ?>
            </div>
        </fieldset>
        <button type="submit" class="btn-primary">Crear club y acceder</button>
    </form>
</section>
