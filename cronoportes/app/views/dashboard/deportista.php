<?php
$title = 'Mi espacio deportivo';
$usuario = $usuario ?? [];
?>
<section class="dashboard">
    <h2>Hola, <?= htmlspecialchars($usuario['nombre'] ?? 'Deportista') ?></h2>
    <p class="help-text">
        Aquí podrás consultar tus entrenamientos, pagos y notificaciones una vez estén disponibles.
    </p>
    <div class="dashboard-grid">
        <article class="card">
            <h3>Próximamente</h3>
            <p>Resúmenes de tus sesiones de entrenamiento y métricas personales.</p>
        </article>
        <article class="card">
            <h3>Pagos y estado</h3>
            <p>Seguimiento a tus mensualidades y matrículas.</p>
        </article>
    </div>
</section>
<section>
    <h2>¿Necesitas ayuda?</h2>
    <p>
        Comunícate con el administrador de tu club para actualizar tus datos o resolver inquietudes.
        Pronto habilitaremos un buzón de soporte para reportar novedades.
    </p>
</section>
