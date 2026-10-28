# HerramientaJB: cómo instalar el frontend

Estos archivos se conectan con **tus 19 migraciones** tal como están. No tienes que cambiar ninguna tabla.

> **Antes de empezar:** haz una copia de seguridad de la carpeta de tu proyecto (copiar y pegar la carpeta completa es suficiente).

---

## 1. Copia los archivos a tu proyecto

Abre este `.zip` y copia cada carpeta **encima** de la de tu proyecto Laravel. Si te pregunta si quieres reemplazar, di que sí.

| Del zip | A tu proyecto | Qué pasa |
|---|---|---|
| `app/` | `app/` | Se agregan Models, Controllers, Requests, Middleware, Services y Exceptions |
| `resources/views/` | `resources/views/` | Se agregan todas las pantallas |
| `resources/css/app.css` | `resources/css/app.css` | **Reemplaza** el archivo |
| `resources/js/app.js` | `resources/js/app.js` | **Reemplaza** el archivo |
| `routes/web.php` | `routes/web.php` | **Reemplaza** el archivo |
| `database/seeders/RolesYAdministradorSeeder.php` | `database/seeders/` | Se agrega |
| `lang/es/validation.php` | `lang/es/` | Mensajes de error en español |
| `vite.config.js` | raíz del proyecto | **Reemplaza** el archivo |

No borres `app/Models/User.php`. Puede quedarse ahí aunque no se use.

---

## 2. Dile a Laravel que tus usuarios están en la tabla `usuarios`

Abre `config/auth.php` y busca esta parte:

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => env('AUTH_MODEL', App\Models\User::class),
    ],
```

Cambia la línea de `'model'` para que quede así:

```php
        'model' => App\Models\Usuario::class,
```

---

## 3. Ajusta el archivo `.env`

Busca estas líneas en `.env` y déjalas así (si alguna no existe, agrégala):

```
APP_LOCALE=es
SESSION_DRIVER=database
```

Verifica también que `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` sean los de tu base de datos.

---

## 4. Instala Tailwind CSS 4

Abre la terminal **dentro de la carpeta del proyecto** y ejecuta:

```bash
npm install
npm install -D tailwindcss@latest @tailwindcss/vite@latest
```

Si en la raíz del proyecto existen los archivos `tailwind.config.js` o `postcss.config.js`, **bórralos**. Tailwind 4 no los necesita y dan error.

---

## 5. Prepara la base de datos y las imágenes

```bash
php artisan migrate
php artisan db:seed --class=RolesYAdministradorSeeder
php artisan storage:link
php artisan optimize:clear
```

El seeder hace tres cosas:
- Crea los roles **Administrador** y **Técnico**.
- Borra el rol **Recepcionista** si existía.
- Crea el usuario administrador inicial.

---

## 6. Enciende el proyecto

Necesitas **dos terminales** abiertas al mismo tiempo, las dos en la carpeta del proyecto:

```bash
# Terminal 1
php artisan serve
```

```bash
# Terminal 2
npm run dev
```

Entra en el navegador a **http://127.0.0.1:8000/login**

- **Correo:** `admin@herramientajb.com`
- **Contraseña:** `Admin12345`

Cuando entres, ve a **Usuarios** y cambia esa contraseña. Desde ahí también creas a los técnicos.

---

## Qué puede hacer cada rol

| Módulo | Administrador | Técnico |
|---|:---:|:---:|
| Panel | ✅ (con ventas y ganancias) | ✅ (sin datos de dinero) |
| Ver productos y stock | ✅ | ✅ |
| Crear, editar y eliminar productos | ✅ | ❌ |
| Categorías y proveedores | ✅ | ❌ |
| Registrar entradas (compras) | ✅ | ❌ |
| Registrar salidas de repuestos | ✅ | ✅ |
| Alertas de stock mínimo | ✅ | ✅ |
| Ver máquinas y hoja de vida | ✅ | ✅ |
| Crear, editar y eliminar máquinas | ✅ | ❌ |
| Editar hoja de vida | ✅ | ✅ |
| Registrar y editar mantenimientos | ✅ | ✅ |
| Eliminar mantenimientos | ✅ | ❌ |
| Cotizaciones y ventas | ✅ | ❌ |
| Usuarios e historial | ✅ | ❌ |

Si un técnico intenta entrar a una página que no le corresponde, verá una pantalla de **"Zona restringida"**.

---

## Cómo funciona el inventario (para tu sustentación)

- **El stock nunca se edita a mano.** Solo cambia con:
  - **Entradas:** compras a un proveedor, que suman stock.
  - **Salidas:** uso en reparaciones, daños o ventas, que restan stock.
- Cada cambio queda guardado en la tabla `movimiento_inventario`. Así hay **trazabilidad**: se sabe qué se movió, cuándo y por qué.
- Si un producto llega a su `stock_minimo`, el sistema crea una alerta en `alertas_inventario`.
- **Las ventas** descuentan el stock automáticamente. Si un producto no alcanza, **no se guarda nada** (transacción de base de datos).
- **Las cotizaciones** no tocan el inventario. Desde una cotización puedes pulsar **"Convertir en venta"**.
- Los precios y totales **siempre se calculan en el servidor** con los precios de la base de datos. Así nadie puede alterar un precio desde el navegador.
- Todas las acciones importantes quedan registradas en `historial_actividades`.

---

## Si algo falla

| Error | Solución |
|---|---|
| `Class "App\Models\User" not found` o no puedes iniciar sesión | Revisa el paso 2 (`config/auth.php`) y ejecuta `php artisan optimize:clear` |
| `Unable to locate file in Vite manifest` | La terminal 2 (`npm run dev`) no está encendida |
| La página se ve sin estilos | Revisa el paso 4 y vuelve a ejecutar `npm run dev` |
| `Cannot find module '@tailwindcss/vite'` | Ejecuta otra vez el paso 4 |
| Las imágenes de productos no aparecen | Ejecuta `php artisan storage:link` |
| Los errores salen en inglés | Pon `APP_LOCALE=es` en `.env` y ejecuta `php artisan optimize:clear` |
| Después de iniciar sesión sale 404 en `/home` (solo Laravel 10) | En `app/Providers/RouteServiceProvider.php` cambia `HOME = '/home'` por `HOME = '/'` |
| `Table 'sessions' doesn't exist` | Ejecuta `php artisan migrate` |
