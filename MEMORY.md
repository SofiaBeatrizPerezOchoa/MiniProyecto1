# MEMORY.md - Bitacora del proyecto MiniProyecto1

## Estado general

- Proyecto Laravel 13 con MySQL (`miniproyecto`) para gestion de alquiler de coches.
- Modulos existentes: Clientes, Oficinas, Coches y Alquileres.
- Las migraciones ya estan ejecutadas en la base de datos local.
- El comando `php` del sistema (8.3.33) no es compatible con las dependencias; usar `C:\laragon\bin\php\php-8.4.25-nts-Win32-vs17-x64\php.exe`.

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

- Interfaz visual con Bootstrap 5.3.3 por CDN; las vistas de Coches son independientes (sin layout global).
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

## Pendientes / notas

- `AGENTS.md` esta en `.gitignore`; si se quiere compartir con el equipo hay que quitar esa linea o forzar `git add -f AGENTS.md`.
- Falta que el equipo integre y pruebe el modulo en conjunto con Oficinas y Alquileres.
- Revisar visualmente las cuatro pantallas en el navegador con datos reales y en tamano movil.
- Seria recomendable agregar pruebas feature del CRUD de coches mas adelante.
