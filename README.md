# RENTA CAR - MiniProyecto1

Sistema de gestion de alquiler de coches desarrollado con Laravel 13.

## Requisitos

- PHP 8.4
- Composer
- MySQL (Laragon)
- Extensiones `pdo_mysql` y `mysqli`

## Instalacion

1. Instalar las dependencias de PHP:

```powershell
composer install
```

2. Crear el archivo de entorno:

```powershell
Copy-Item .env.example .env
```

3. Configurar la base de datos en `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miniproyecto
DB_USERNAME=root
DB_PASSWORD=
```

La base de datos `miniproyecto` debe existir en MySQL.

4. Generar la clave de la aplicacion:

```powershell
php artisan key:generate
```

5. Crear las tablas y los usuarios demo:

```powershell
composer db:setup
```

Este comando ejecuta las migraciones y el seeder. Es seguro ejecutarlo varias veces porque el seeder es idempotente.

Si las tablas ya existen y solo faltan los usuarios, tambien se puede ejecutar:

```powershell
php artisan db:seed --force
```

6. Iniciar el servidor:

```powershell
php artisan serve
```

## Usuarios demo

| Tipo de usuario | Nombre completo | Usuario | Contrasena |
| --- | --- | --- | --- |
| Administrador | Prueba Administrador | `admin` | `12345678` |
| Empleado | Prueba Empleado | `empleado` | `12345678` |

Al crear un usuario, el nombre de usuario se genera automaticamente a partir del nombre completo: inicial del primer nombre mas el primer apellido (por ejemplo, `Zulmy Nicolle Bonilla Canales` genera `zbonilla`). Si ya existe, se usa el primer nombre mas la inicial del apellido y, si tambien existe, se agrega un numero. El campo sigue siendo editable.

El administrador puede acceder a todos los modulos. El empleado solo puede acceder a clientes, coches y alquileres.

Estas credenciales son solo para desarrollo. Cambiarlas antes de usar el sistema en produccion.

## Pruebas

Las pruebas usan SQLite en memoria. Si `pdo_sqlite` no esta habilitado en el `php.ini`, ejecutar:

```powershell
php -d extension=pdo_sqlite -d extension=sqlite3 vendor/bin/pest
```

Tambien se puede habilitar `extension=pdo_sqlite` y `extension=sqlite3` en el `php.ini` de PHP 8.4.

## Notas

- No copiar la carpeta `vendor/` entre computadoras; cada una debe ejecutar `composer install`.
- No existe registro publico ni verificacion de correo.
- Los usuarios se autentican con `username` y contrasena.
