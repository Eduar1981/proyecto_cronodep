<?php
$title = 'Ingresar a CronoDep';
$data = $data ?? ['correo' => ''];
$errors = $errors ?? [];
?>
<section class="auth-card">
    <h2>Iniciar sesión</h2>
    <?php if (!empty($errors['general'])): ?>
        <p class="alert alert-error"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>
    <form method="post" action="<?= htmlspecialchars(route('/login')) ?>" class="form-grid">
        <div class="form-control">
            <label for="correo">Correo electrónico</label>
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
        <button type="submit" class="btn-primary">Ingresar</button>
    </form>
    <?php if ((int) ($data['clubs_registrados'] ?? 1) === 0): ?>
        <p class="help-text">
            ¿Aún no tienes tu club? <a href="<?= htmlspecialchars(route('/register-club')) ?>">Registra el primero aquí</a>.
        </p>
    <?php endif; ?>
</section>
