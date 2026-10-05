# WebFiesta - Sistema de Entradas

Sistema de gestión de entradas para fiestas privadas con pago manual por Bizum, desarrollado en Laravel.

## Requisitos
- PHP 8.2+
- Composer
- Laravel Herd (recomendado para desarrollo local en Windows/macOS)

## Configuración Local (Laravel Herd)

Laravel 11 utiliza SQLite por defecto, lo cual es perfecto para desarrollo local con Herd. No necesitas configurar MySQL.

1. Abre tu terminal en la carpeta del proyecto.
2. Ejecuta las migraciones para crear la base de datos `database/database.sqlite`:
```bash
php artisan migrate
```
3. Si usas Laravel Herd y el proyecto está en tu carpeta de Herd, puedes acceder directamente en `http://webfiesta.test`. Si no, ejecuta:
```bash
php artisan serve
```

## Configuración en Producción (Debian Linux / AWS EC2)

Para desplegar en un servidor Linux, se recomienda usar **MySQL** o **PostgreSQL** para mayor concurrencia y seguridad, además de servir la aplicación mediante Nginx y PHP-FPM.

### Pasos de Despliegue:

1. **Clonar repositorio y dependencias:**
```bash
git clone <tu-repo> /var/www/webfiesta
cd /var/www/webfiesta
composer install --optimize-autoloader --no-dev
```

2. **Configurar Entorno (`.env`):**
Copia el archivo `.env.example` a `.env` y ajusta las siguientes variables esenciales para producción:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# ==========================================
# CONFIGURACIÓN DE BASE DE DATOS (PRODUCCIÓN)
# ==========================================
# Cambia DB_CONNECTION a mysql (o pgsql)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

3. **Generar Clave, Migrar y Optimizar:**
```bash
php artisan key:generate
php artisan migrate --force
php artisan optimize
php artisan view:cache
```

4. **Permisos Correctos:**
Asegúrate de que el usuario de Nginx/Apache (usualmente `www-data`) tenga permisos sobre las carpetas `storage` y `bootstrap/cache`:
```bash
sudo chown -R www-data:www-data /var/www/webfiesta/storage /var/www/webfiesta/bootstrap/cache
sudo chmod -R 775 /var/www/webfiesta/storage /var/www/webfiesta/bootstrap/cache
```

5. **Configuración de Correo (Opcional):**
Para enviar los correos de confirmación al marcar "Marcar como Pagado", configura tus credenciales SMTP en el `.env` (ej. Mailgun, Postmark, AWS SES, o Gmail SMTP).

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.tuservidor.com
MAIL_PORT=587
MAIL_USERNAME=tu_usuario_smtp
MAIL_PASSWORD=tu_password_smtp
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="entradas@tufiesta.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Trabajos en Segundo Plano (Jobs)
Actualmente el controlador emite un Log, pero si decides usar Jobs/Events (`event(new \App\Events\EntradaPagada($entrada));`) y `QUEUE_CONNECTION=database` o `redis`, recuerda correr el worker de Laravel en tu servidor usando Supervisor:
```bash
php artisan queue:work --queue=default --tries=3
```
