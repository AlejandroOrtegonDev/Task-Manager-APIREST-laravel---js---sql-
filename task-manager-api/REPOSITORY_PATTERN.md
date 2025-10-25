# Patrón Repository en Laravel

Este proyecto implementa el patrón Repository para una mejor organización del código y separación de responsabilidades.

## Estructura del Patrón Repository

### Archivos Creados

```
app/
├── Models/
│   └── Category.php                    # Modelo Eloquent
├── Repositories/
│   ├── RepositoryInterface.php         # Interfaz base del repositorio
│   ├── BaseRepository.php              # Implementación base
│   └── CategoryRepository.php          # Repositorio específico para Category
├── Http/
│   └── Controllers/
│       └── CategoryController.php      # Controlador que usa el repositorio
└── Providers/
    └── AppServiceProvider.php          # Registro de los repositorios
```

## Cómo Usar el Patrón Repository

### 1. Métodos Básicos (Heredados de BaseRepository)

Todos los repositorios que extienden `BaseRepository` tienen estos métodos:

- `all()` - Obtiene todos los registros
- `find($id)` - Busca un registro por ID
- `create($data)` - Crea un nuevo registro
- `update($id, $data)` - Actualiza un registro
- `delete($id)` - Elimina un registro

### 2. Métodos Específicos

Puedes agregar métodos específicos en tu repositorio:

```php
// En CategoryRepository.php
public function allOrderedByName()
{
    return $this->model->orderBy('name')->get();
}

public function searchByName($term)
{
    return $this->model->where('name', 'like', "%{$term}%")->get();
}
```

### 3. Uso en Controladores

El repositorio se inyecta automáticamente mediante el contenedor de Laravel:

```php
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return response()->json($categories);
    }
}
```

## Ventajas del Patrón Repository

1. **Separación de responsabilidades**: Los controladores no interactúan directamente con el modelo
2. **Reutilización**: Lógica de base de datos centralizada en un solo lugar
3. **Testabilidad**: Fácil crear mocks de los repositorios para testing
4. **Flexibilidad**: Fácil cambiar la implementación sin afectar el resto del código
5. **Mantenimiento**: Cambios en la lógica de base de datos se hacen en un solo lugar

## Crear un Nuevo Repositorio

### Paso 1: Crear el Modelo (si no existe)
```bash
php artisan make:model Product
```

### Paso 2: Crear el Repositorio
```php
// app/Repositories/ProductRepository.php
<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    // Agregar métodos específicos aquí
}
```

### Paso 3: Registrar en AppServiceProvider
```php
// app/Providers/AppServiceProvider.php
use App\Repositories\ProductRepository;
use App\Models\Product;

public function register(): void
{
    $this->app->bind(ProductRepository::class, function ($app) {
        return new ProductRepository(new Product());
    });
}
```

## Rutas de la API

Las rutas para el recurso Category ya están configuradas:

- `GET /api/categories` - Listar todas las categorías
- `POST /api/categories` - Crear una nueva categoría
- `GET /api/categories/{id}` - Mostrar una categoría específica
- `PUT /api/categories/{id}` - Actualizar una categoría
- `DELETE /api/categories/{id}` - Eliminar una categoría

## Ejemplos de Uso

### Crear una Categoría
```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Electronics",
    "description": "Electronic products"
  }'
```

### Obtener Todas las Categorías
```bash
curl http://localhost:8000/api/categories
```

### Actualizar una Categoría
```bash
curl -X PUT http://localhost:8000/api/categories/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Home & Electronics",
    "description": "Updated description"
  }'
```

### Eliminar una Categoría
```bash
curl -X DELETE http://localhost:8000/api/categories/1
```

## Migraciones

No olvides ejecutar las migraciones:

```bash
php artisan migrate
```

## Notas

- El patrón Repository está especialmente útil en proyectos grandes
- Facilita el testing unitario
- Permite cambiar fácilmente de ORM si es necesario
- Mantén la lógica de negocio simple en los repositorios
