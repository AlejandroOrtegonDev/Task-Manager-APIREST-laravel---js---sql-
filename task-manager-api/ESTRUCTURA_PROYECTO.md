# Estructura del Proyecto Laravel + Vue.js

```
task-manager-api/
│
├── app/                                    # Aplicación Laravel
│   ├── Console/
│   │   └── Kernel.php                     # Comandos de consola
│   │
│   ├── Exceptions/
│   │   └── Handler.php                    # Manejo de excepciones
│   │
│   ├── Http/
│   │   ├── Controllers/                   # Controladores
│   │   │   ├── Controller.php            # Controlador base
│   │   │   └── CategoryController.php    # Controlador de categorías
│   │   │
│   │   ├── Middleware/                    # Middleware
│   │   │   ├── Authenticate.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustHosts.php
│   │   │   ├── TrustProxies.php
│   │   │   ├── ValidateSignature.php
│   │   │   └── VerifyCsrfToken.php
│   │   │
│   │   └── Kernel.php                     # Registro de middleware
│   │
│   ├── Models/                            # Modelos Eloquent
│   │   ├── Category.php                  # Modelo de categorías
│   │   └── User.php                      # Modelo de usuarios
│   │
│   ├── Providers/                        # Service Providers
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   │
│   └── Repositories/                     # Patrón Repository
│       ├── BaseRepository.php           # Repositorio base
│       └── CategoryRepository.php       # Repositorio de categorías
│
├── bootstrap/
│   ├── app.php                           # Bootstrap de la aplicación
│   └── cache/                            # Cache de bootstrap
│       ├── packages.php
│       └── services.php
│
├── config/                               # Archivos de configuración
│   ├── app.php                           # Configuración general
│   ├── auth.php                          # Autenticación
│   ├── broadcasting.php                  # Broadcasting
│   ├── cache.php                         # Cache
│   ├── cors.php                          # CORS
│   ├── database.php                      # Base de datos
│   ├── filesystems.php                   # Sistemas de archivos
│   ├── hashing.php                       # Hashing
│   ├── logging.php                       # Logging
│   ├── mail.php                          # Correo
│   ├── queue.php                         # Colas
│   ├── sanctum.php                       # Laravel Sanctum
│   ├── services.php                      # Servicios externos
│   ├── session.php                       # Sesiones
│   └── view.php                          # Vistas
│
├── database/
│   ├── database.sqlite                   # Base de datos SQLite
│   │
│   ├── factories/                       # Factories para datos de prueba
│   │   └── UserFactory.php
│   │
│   ├── migrations/                       # Migraciones de base de datos
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   └── 2025_10_24_182317_create_categories_table.php
│   │
│   └── seeders/                          # Seeders
│       └── DatabaseSeeder.php
│
├── public/                               # Directorio público
│   ├── favicon.ico
│   ├── index.php                         # Punto de entrada
│   └── robots.txt
│
├── resources/                            # Recursos de la aplicación
│   ├── css/
│   │   └── app.css                       # Estilos globales
│   │
│   ├── js/                               # JavaScript/Vue.js
│   │   ├── app.js                        # ⭐ Inicializa Vue
│   │   ├── bootstrap.js                  # Configuración de axios
│   │   └── components/                   # Componentes Vue
│   │       └── App.vue                   # ⭐ Componente principal
│   │
│   └── views/                            # Vistas Blade
│       └── welcome.blade.php            # ⭐ Vista principal con Vue
│
├── routes/                               # Rutas
│   ├── api.php                           # Rutas API
│   ├── channels.php                      # Canales de broadcasting
│   ├── console.php                       # Rutas de consola
│   └── web.php                           # Rutas web
│
├── storage/                              # Archivos almacenados
│   ├── app/
│   │   └── public/
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   └── logs/                             # Logs de la aplicación
│
├── tests/                                # Tests
│   ├── Feature/
│   │   └── ExampleTest.php
│   ├── Unit/
│   │   └── ExampleTest.php
│   ├── CreatesApplication.php
│   └── TestCase.php
│
├── vendor/                               # Dependencias de Composer
│   └── [librerías de Laravel y otros paquetes]
│
├── artisan                               # CLI de Laravel
├── composer.json                         # Dependencias PHP
├── composer.lock                         # Lock de dependencias
├── package.json                          # Dependencias NPM
├── phpunit.xml                           # Configuración de PHPUnit
├── vite.config.js                        # ⭐ Configuración de Vite + Vue
├── README.md                             # Documentación principal
└── REPOSITORY_PATTERN.md                 # Documentación del patrón Repository
```

## 📋 Archivos Principales de Vue.js

Los archivos marcados con ⭐ son los relacionados con Vue.js:

### 1. **vite.config.js**
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
```

### 2. **resources/js/app.js**
```javascript
import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';

const app = createApp(App);
app.mount('#app');
```

### 3. **resources/js/components/App.vue**
Componente principal de Vue con:
- Contador interactivo
- Conexión con API
- Información del proyecto
- Estilos modernos con gradientes

### 4. **resources/views/welcome.blade.php**
```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- ... meta tags ... -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
```

## 🚀 Comandos Útiles

### Desarrollo
```bash
# Instalar dependencias PHP
composer install

# Instalar dependencias NPM
npm install

# Compilar assets en modo desarrollo
npm run dev

# Servidor Laravel
php artisan serve

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Producción
```bash
# Compilar assets para producción
npm run build

# Optimizar aplicación
php artisan optimize
```

## 📦 Dependencias Instaladas

### NPM (package.json)
- **vue**: ^3.4.15 - Framework Vue.js
- **@vitejs/plugin-vue**: Plugin de Vue para Vite
- **axios**: ^1.6.4 - Cliente HTTP
- **laravel-vite-plugin**: ^1.0.0 - Plugin de Laravel para Vite
- **vite**: ^5.0.0 - Build tool

### Composer (composer.json)
- **laravel/framework**: ^10.10 - Framework Laravel
- **laravel/sanctum**: ^3.3 - Autenticación API
- **laravel/tinker**: ^2.8 - REPL de Laravel

## 🗂️ Funcionalidades del Proyecto

### Backend (Laravel)
- ✅ Sistema de autenticación con Sanctum
- ✅ Modelo Category con Repository Pattern
- ✅ API REST para categorías
- ✅ Migraciones de base de datos
- ✅ Configuración CORS

### Frontend (Vue.js)
- ✅ Componente principal App.vue
- ✅ Contador interactivo
- ✅ Conexión con API Laravel
- ✅ Diseño responsive con gradientes
- ✅ Vite para desarrollo rápido

## 📁 Organización del Código

### Repositorios
El proyecto usa el patrón Repository para abstraer la lógica de acceso a datos:
- `BaseRepository.php` - Métodos CRUD genéricos
- `CategoryRepository.php` - Lógica específica de categorías

### Controladores
- `CategoryController.php` - Maneja las peticiones HTTP para categorías

### Modelos
- `Category.php` - Modelo Eloquent para categorías
- `User.php` - Modelo de usuarios

