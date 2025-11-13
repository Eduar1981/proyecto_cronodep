# CronoDep MVC

Este repositorio contiene la estructura base del proyecto **CronoDep** implementado en PHP puro bajo el patrón **Modelo-Vista-Controlador (MVC)**, con frontend en HTML, CSS y JavaScript y conexión a la base de datos MySQL/MariaDB provista.

## 📁 Estructura principal

```
cronoportes/
├── app/
│   ├── config/        # Configuración general (BD y ajustes de la app)
│   ├── controllers/   # Controladores que orquestan la lógica de negocio
│   ├── models/        # Modelos que interactúan con la base de datos
│   └── views/         # Vistas HTML reutilizando un layout principal
├── core/              # Router y utilidades del núcleo MVC
├── database/          # Scripts SQL iniciales (cronodep.sql)
├── public/            # Punto de entrada (index.php) y recursos estáticos
└── routes/            # Definición de rutas HTTP disponibles
```

## ⚙️ Requisitos previos

- PHP 8.1 o superior con extensiones `pdo` y `pdo_mysql` habilitadas.
- Servidor web configurado para apuntar a `cronoportes/public` como raíz del documento (por ejemplo Apache o Nginx).
- MySQL o MariaDB para ejecutar el script `database/cronodep.sql`.

## 🚀 Puesta en marcha

1. Clona el repositorio y navega a la carpeta del proyecto.
2. Importa la base de datos ejecutando:
   ```bash
   mysql -u <usuario> -p < database/cronodep.sql
   ```
3. Copia `cronoportes/app/config/config.php` y ajusta las credenciales de la base de datos si es necesario.
4. Configura el host virtual de tu servidor para que el documento raíz sea `cronoportes/public`.
5. Accede en el navegador a la URL configurada (por defecto `http://localhost/`).

## 🌐 Rutas incluidas

| Ruta              | Controlador / Acción          | Descripción                              |
|-------------------|-------------------------------|------------------------------------------|
| `/`               | `HomeController@index`        | Panel con totales y usuarios recientes. |
| `/usuarios`       | `UsuarioController@index`     | Listado general de usuarios.            |
| `/usuarios/{id}`  | `UsuarioController@show`      | Detalle de un usuario puntual.          |
| `/clubs`          | `ClubController@index`        | Listado general de clubs.               |

## 🗄️ Conexión a la base de datos

El archivo `database/cronodep.sql` contiene exactamente la estructura entregada para el SaaS, con tablas de clubs, usuarios, entrenamientos, pagos y relaciones. El `Model` base inicializa una conexión PDO reutilizable que aprovechan los modelos específicos (`Club` y `Usuario`).

## 🎨 Frontend

- Layout responsive basado en CSS puro (`public/css/styles.css`).
- Interacciones mínimas con JavaScript (`public/js/app.js`) para resaltar la ruta activa.
- Las vistas se renderizan mediante el layout principal y reciben los datos desde los controladores.

## ➕ Próximos pasos sugeridos

- Añadir controladores y modelos adicionales para entrenamientos, pagos y reportes.
- Implementar formularios de autenticación y gestión de sesiones.
- Incorporar validaciones y manejo de errores más detallado.
- Crear seeds o datos de ejemplo para acelerar las pruebas iniciales.

---

Con esta base puedes continuar evolucionando CronoDep siguiendo el patrón MVC y sin dependencias externas como Composer.
