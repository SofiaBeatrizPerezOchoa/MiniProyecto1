# MEMORY.md - Bitacora del proyecto MiniProyecto1

## Estado general

- Proyecto Laravel 13 con MySQL (`miniproyecto`) para gestion de alquiler de coches.
- Modulos existentes: Clientes, Oficinas, Coches y Alquileres.
- `AGENTS.md` esta en `.gitignore`; si se quiere compartir con el equipo hay que quitar esa linea o forzar `git add -f AGENTS.md`.
- Las migraciones ya estan ejecutadas en la base de datos local.
- El comando `php` del sistema (8.3.33) no es compatible con las dependencias; usar `C:\laragon\bin\php\php-8.4.25-Win32-vs17-x64\php.exe`.

## Modulo Coches

### Completado

- `Coche` ahora tiene `$fillable` con todos los campos de la tabla.
- `CocheController` implementa el CRUD completo:
  - `index`: lista todos los coches.
  - `create`: muestra formulario de alta.
  - `store`: valida y guarda.
  - `show`: muestra el detalle.
  - `edit`: muestra formulario de edicion.
  - `update`: valida y actualiza (matricula unica ignorando el registro actual).
  - `destroy`: elimina el registro.
- Vistas creadas/actualizadas:
  - `coche/index.blade.php`: tabla con todos los campos y acciones Ver / Editar / Eliminar.
  - `coche/create.blade.php`: formulario de alta.
  - `coche/edit.blade.php`: formulario de edicion precargado.
  - `coche/show.blade.php`: ficha de detalle.
- La eliminacion usa `POST` + `@method('DELETE')`, no enlaces GET.
- Se corrigio `coche/index.blade.php`, que antes usaba campos inexistentes (`año`, `color`).

### Reglas de validacion aplicadas

- `matricula`: requerida, string, max 20, unica.
- `grupo`: requerido, string, max 20.
- `marca` y `modelo`: requeridos, string, max 50.
- `numero_puertas` y `numero_plazas`: requeridos, enteros, minimo 1.
- `capacidad_maletero` y `edad_minima`: requeridos, enteros, minimo 0.
- `codigo_oficina`: requerido, string, max 10.
- `estado`: requerido, string, max 20.

### Decisiones

- Interfaz visual con Bootstrap 5.3.3 por CDN; desde el 2026-11-06 las vistas de Coches usan el layout compartido `layouts.app`.
- `codigo_oficina` sigue siendo texto libre; `grupo` y `estado` se seleccionan desde combobox en los formularios.
- No se agregaron seeders ni datos de prueba.

### Verificacion realizada (2026-11-04)

- Las 7 rutas resource de `coche` estan registradas y responden.
- Las vistas Blade compilan correctamente con `view:cache`.
- Se ejecuto una prueba temporal de integracion (crear, listar, ver, editar, eliminar y validaciones): 2 pruebas, 27 aserciones, todas correctas. Los datos se revirtieron; la tabla `coches` quedo vacia.
- `pint` y `phpstan` pasan para `Coche.php` y `CocheController.php`.
- El lint global del repo sigue fallando por archivos de otros modulos (Clientes, Oficinas, Alquileres, migraciones y `routes/web.php`), no por el modulo Coches.

### Interfaz visual con Bootstrap (2026-11-05)

- Se agrego Bootstrap 5.3.3 por CDN (CSS y JS bundle) a las cuatro vistas de Coches.
- Se implemento un sidebar comun con la marca `Renta Car` y enlaces a Panel, Oficinas, Coches, Clientes y Alquileres.
- `coche/index.blade.php`: encabezado con boton `Nuevo Coche`, busqueda por matricula/marca/modelo, filtro de grupo por combobox, botones `Filtrar` / `Limpiar`, tabla responsive con todos los campos, badges distintivos por estado y acciones con iconos.
- `coche/create.blade.php` y `coche/edit.blade.php`: formulario en tarjeta con grid de 3 columnas, placeholders, asteriscos en campos obligatorios, errores por campo y resumen de validacion.
- `grupo` ahora es un select con `Grupo A` a `Grupo F`; `estado` es un select con `Disponible`, `Alquilado`, `Devuelto`, `En Mantenimiento`, `Retrasado` y `En baja`. En edicion se conserva el valor actual si no pertenece a la lista.
- La capacidad del maletero se muestra y solicita en litros.
- `coche/show.blade.php`: ficha de detalle organizada en tarjetas y bloque destacado con icono y color segun el estado.
- Se agrego Bootstrap Icons 1.11.3 por CDN para los iconos de acciones y estados.
- No se modifico el controlador, modelo, rutas ni migraciones.
- Verificacion (2026-11-05): `view:cache` compilo correctamente, las 7 rutas de coche estan registradas y las 4 vistas respondieron HTTP 200 con los datos existentes.

## Modulo Alquileres

### Completado (2026-11-05)

- `Alquiler` ahora tiene `$fillable` con todos los campos de la tabla y `$casts` para fechas, enteros y decimales.
- `AlquilerController` implementa el CRUD completo:
  - `index`: lista los alquileres mas recientes.
  - `create`: muestra formulario de alta.
  - `store`: valida y guarda.
  - `show`: muestra el detalle.
  - `edit`: muestra formulario de edicion precargado.
  - `update`: valida y actualiza.
  - `destroy`: elimina el registro.
- Vistas creadas/actualizadas:
  - `alquiler/index.blade.php`: tabla con todos los campos, filtros por texto, seguro y estado, botones `Filtrar` / `Limpiar` y acciones Ver / Editar / Eliminar.
  - `alquiler/create.blade.php`: formulario de alta con botones `Guardar Alquiler`, `Limpiar` y `Cancelar`.
  - `alquiler/edit.blade.php`: formulario de edicion precargado con botones `Guardar cambios`, `Limpiar` y `Cancelar`.
  - `alquiler/show.blade.php`: ficha de detalle con estado de devolucion y botones Editar / Volver.
- La eliminacion usa `POST` + `@method('DELETE')`.
- Se reemplazo la vista `index` anterior, que usaba relaciones inexistentes (`cliente`, `coche`) y campos que no existen en la tabla (`fecha_fin`, `costo_total`).

### Reglas de validacion aplicadas

- `matricula`: requerida, string, max 20.
- `dni`: requerido, string de exactamente 13 digitos.
- `fecha_inicio`: requerida, fecha.
- `fecha_devolucion_prevista`: requerida, fecha, mayor o igual a `fecha_inicio`.
- `fecha_devolucion_real`: opcional, fecha, mayor o igual a `fecha_inicio`.
- `duracion_dias`: requerido, entero, minimo 1.
- `tipo_seguro`: requerido, string, max 30.
- `precio_total` y `recargo`: requeridos, numericos, minimo 0.

### Decisiones

- Se implemento **sin relaciones Eloquent**: `matricula` y `dni` se capturan como datos libres y no se valida su existencia en `coches` o `clientes`.
- `dni` se cambio de `int` a `varchar(13)` mediante la migracion `2026_11_05_170203_change_dni_to_string_on_alquilers_table.php` para aceptar exactamente 13 digitos (incluidos ceros iniciales).
- `tipo_seguro` es un select con `Basico`, `Completo`, `Premium` y `Sin seguro`; al editar se conserva el valor actual si no pertenece a la lista.
- El estado mostrado se deriva de `fecha_devolucion_real`: `Devuelto` si tiene fecha, `Pendiente` si esta vacia.
- Se mantiene el diseno Bootstrap 5.3.3 de Coches/Oficinas: sidebar `Renta Car`, tarjetas, badges, filtros y botones de accion.

### Verificacion realizada (2026-11-05)

- Las 7 rutas resource de `alquiler` estan registradas.
- `view:cache` compilo correctamente las vistas Blade.
- Prueba temporal de integracion (crear, listar, ver, editar, eliminar y validaciones): 2 pruebas, 21 aserciones, todas correctas. Los datos se revirtieron; la tabla `alquilers` quedo vacia.
- Migracion `change_dni_to_string_on_alquilers_table` ejecutada correctamente; la columna `alquilers.dni` quedo como `varchar(13)`.
- Prueba temporal del DNI de 13 digitos (alta, edicion, borrado y rechazo de DNI de 8 digitos): 2 pruebas, 13 aserciones, todas correctas. Los datos se revirtieron; la tabla `alquilers` quedo vacia.
- `pint` y `phpstan` pasan para `Alquiler.php`, `AlquilerController.php` y la migracion.

## Modulo Clientes

### Completado

- `Cliente` ahora tiene `$primaryKey = 'DNI'`, `$incrementing = false`, `$keyType = 'string'` y `$fillable` con todos los campos de la tabla.
- `ClienteController` implementa el CRUD completo:
  - `index`: lista todos los clientes.
  - `create`: muestra formulario de alta.
  - `store`: valida y guarda.
  - `show`: muestra el detalle.
  - `edit`: muestra formulario de edicion precargado.
  - `update`: valida y actualiza (DNI unico ignorando el registro actual).
  - `destroy`: elimina el registro.
- Vistas creadas/actualizadas:
  - `cliente/index.blade.php`: tabla con todos los campos y acciones Ver / Editar / Eliminar.
  - `cliente/create.blade.php`: formulario de alta.
  - `cliente/edit.blade.php`: formulario de edicion precargado.
  - `cliente/details.blade.php`: ficha de detalle (`show`).
- La eliminacion usa `POST` + `@method('DELETE')`, no enlaces GET.
- Se corrigio `cliente/index.blade.php`, que antes usaba `{{$cliente->id}}` (inexistente, PK es `DNI`) y enlaces GET a `/delete` (incorrectos).

### Reglas de validacion aplicadas

- `DNI`: requerido, string, max 13, unico.
- `nombre`: requerido, string, max 120.
- `direccion`: requerido, string, max 100.
- `telefono`: requerido, string, max 8.
- `tarjeta_credito`: opcional, string, max 16.

### Decisiones

- Interfaz visual con Bootstrap 5.3.3 por CDN; desde el 2026-11-06 las vistas de Clientes usan el layout compartido `layouts.app`.
- El segmento de ruta se resuelve por `DNI` (clave primaria), no por `id`.
- No se agregaron seeders ni datos de prueba.

### Verificacion realizada (2026-11-05)

- La ruta resource de `cliente` esta registrada.
- `view:cache` compila correctamente las vistas Blade de Clientes.

## Autenticacion, roles y modulo Usuarios (2026-11-06)

### Completado

- Autenticacion por `username` + `password` con `LoginController` (`GET/POST /login`, `POST /logout`). No hay registro publico (`/registro` y `/register` devuelven 404).
- Login redirige a `/`; `/` es el dashboard protegido por `auth` y muestra "Bienvenido a RENTA CAR".
- Se usa `spatie/laravel-permission` con roles `administrador` y `empleado`.
- Matriz de acceso:
  - `administrador`: cliente, coche, alquiler, oficina y usuario.
  - `empleado`: cliente, coche y alquiler.
- `UsuarioController` implementa index, create, store, edit, update y `PATCH /usuario/{usuario}/estado` (habilitar/deshabilitar). No hay `show` ni `destroy`.
- Reglas del modulo Usuarios:
  - `username` unico, normalizado a minusculas y sin espacios; `email` nullable; `activo` booleano (default `true`).
  - Contrasena obligatoria al crear y opcional al editar (minimo 8, confirmada).
  - No se puede deshabilitar la propia cuenta ni el ultimo administrador activo.
  - El ultimo administrador activo no puede perder el rol `administrador`.
- Migracion `2026_11_06_060000_add_username_and_activo_to_users_table.php` y migracion de Spatie ejecutadas en la base local.
- `RolesAndAdminUserSeeder` es idempotente: crea los roles y el usuario inicial `admin` / `12345678` (nombre `Administrador`, activo, rol `administrador`). `DatabaseSeeder` lo invoca.
- Layout compartido:
  - `layouts/app.blade.php` con sidebar condicional por rol.
  - `layouts/guest.blade.php` para login.
  - `layouts/partials/theme.blade.php` con el CSS comun.
  - Las 16 vistas de alquiler, coche, cliente y oficina se refactorizaron a `@extends('layouts.app')` conservando su contenido.
- Mensajes en espanol en `lang/es/auth.php` y `lang/es/validation.php`; `APP_LOCALE=es`.
- Rate limiter `login`: 5 intentos por minuto por username + IP.
- Pruebas creadas en `tests/Feature/Auth/` y `tests/Feature/Usuario/UsuarioManagementTest.php`.

### Verificacion realizada

- `vendor/bin/pest`: 24 pruebas, 24 correctas, 95 aserciones.
- `pint --test` y `phpstan analyse --memory-limit=1G`: correctos para los archivos modificados/nuevos.
- `view:cache`: compila correctamente todas las vistas.
- Seeder ejecutado dos veces sin duplicar roles ni usuarios; `admin` queda con rol `administrador`.

### Nota sobre pruebas y SQLite

- PHP 8.4.25 tiene los DLL `php_pdo_sqlite.dll` y `php_sqlite3.dll`, pero no estan habilitados en `php.ini`.
- `php artisan test` lanza un subproceso que no hereda los `-d`, por lo que falla con "could not find driver".
- Comando de pruebas que funciona:
  `C:\laragon\bin\php\php-8.4.25-Win32-vs17-x64\php.exe -d extension=pdo_sqlite -d extension=sqlite3 vendor/bin/pest`
- Alternativa futura: habilitar `extension=pdo_sqlite` y `extension=sqlite3` en el `php.ini` de PHP 8.4.25.

## Pendientes / notas

- `AGENTS.md` esta en `.gitignore`; si se quiere compartir con el equipo hay que quitar esa linea o forzar `git add -f AGENTS.md`.
- Falta que el equipo integre y pruebe el modulo en conjunto con Oficinas y Alquileres.
- Revisar visualmente las cuatro pantallas en el navegador con datos reales y en tamano movil.
- Seria recomendable agregar pruebas feature del CRUD de coches mas adelante.
- Evaluar permisos granulares con Spatie; actualmente el control de acceso es por rol.
- Revisar visualmente login, dashboard, modulo de usuarios y sidebar en tamano movil.
- Habilitar `pdo_sqlite` y `sqlite3` en el `php.ini` de PHP 8.4.25 para poder usar `artisan test` sin parametros `-d`.
