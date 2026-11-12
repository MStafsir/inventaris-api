<?php

declare(strict_types=1);

use App\Config\Database;
use App\Core\Router;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Middleware\ErrorHandler;
use App\Exceptions\NotFoundException;

require dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;

Dotenv::createImmutable(dirname(__DIR__))->load();

ErrorHandler::register();

header('Content-Type: application/json; charset=utf-8');

try {
    $db = Database::connection();

    $productRepository = new ProductRepository($db);
    $categoryRepository = new CategoryRepository($db);

    $productService = new ProductService($productRepository, $categoryRepository);
    $categoryService = new CategoryService($categoryRepository);

    $productController = new ProductController($productService);
    $categoryController = new CategoryController($categoryService);

    $router = new Router();

    $registerRoutes = require dirname(__DIR__) . '/routes/api.php';

    $registerRoutes(
        $router,
        $productController,
        $categoryController
    );

    $router->dispatch(
        $_SERVER['REQUEST_METHOD'],
        $_SERVER['REQUEST_URI']
    );

} catch (NotFoundException | InvalidArgumentException $e) {
    throw $e;
} catch (Throwable $e) {
    error_log((string) $e);

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan internal server'
    ]);
}
