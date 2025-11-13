<?php
$title = 'Bienvenido a CronoDep';
$clubsRegistrados = $clubsRegistrados ?? 0;
?>
<section class="landing">
    <div class="landing-hero">
        <h2>Gestión integral de entrenamientos y clubes deportivos</h2>
        <p>
            CronoDep centraliza el control de deportistas, entrenadores y pagos en una única plataforma.
            Administra tus sesiones, registra la asistencia y genera reportes en segundos.
        </p>
        <div class="landing-actions">
            <?php if ($clubsRegistrados === 0): ?>
                <a class="btn" href="<?= htmlspecialchars(route('/register-club')) ?>">Crear mi primer club</a>
            <?php else: ?>
                <a class="btn" href="<?= htmlspecialchars(route('/login')) ?>">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="landing-summary">
        <article class="card">
            <h3>Roles soportados</h3>
            <p>Superadmins, administradores, instructores, deportistas, acudientes y tesoreros.</p>
        </article>
        <article class="card">
            <h3>Base de datos lista</h3>
            <p>Compatibilidad con MariaDB y la estructura definida para clubes, usuarios y entrenamientos.</p>
        </article>
        <article class="card">
            <h3>Seguridad integrada</h3>
            <p>Inicio de sesión con contraseñas cifradas y control de acceso por roles.</p>
        </article>
    </div>
</section>
