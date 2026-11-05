# MEMORY.md - Bitacora del proyecto MiniProyecto1

## Estado general

- Proyecto Laravel 13 con MySQL (`miniproyecto`) para gestion de alquiler de coches.
- Modulos existentes: Clientes, Oficinas, Coches y Alquileres.
- Las migraciones ya estan ejecutadas en la base de datos local.
- El comando `php` del sistema (8.2.33) no es compatible con las dependencias; usar `C:\laragon\bin\php\php-8.4.25-Win32-vs17-x64\php.exe`.

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

- Sin pantallas con interfaz grafica elaborada: solo Blade + HTML basico.
- `estado` y `codigo_oficina` son texto libre (sin select ni clave foranea) para mantenerlo simple.
- No se agregaron seeders ni datos de prueba.

### Verificacion realizada (2026-11-04)

- Las 7 rutas resource de `coche` estan registradas y responden.
- Las vistas Blade compilan correctamente con `view:cache`.
- Se ejecuto una prueba temporal de integracion (crear, listar, ver, editar, eliminar y validaciones): 2 pruebas, 27 aserciones, todas correctas. Los datos se revirtieron; la tabla `coches` quedo vacia.
- `pint` y `phpstan` pasan para `Coche.php` y `CocheController.php`.
- El lint global del repo sigue fallando por archivos de otros modulos (Clientes, Oficinas, Alquileres, migraciones y `routes/web.php`), no por el modulo Coches.

## Pendientes / notas

- `AGENTS.md` esta en `.gitignore`; si se quiere compartir con el equipo hay que quitar esa linea o forzar `git add -f AGENTS.md`.
- Falta que el equipo integre y pruebe el modulo en conjunto con Oficinas y Alquileres.
- Seria recomendable agregar pruebas feature del CRUD de coches mas adelante.
