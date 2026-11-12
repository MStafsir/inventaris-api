<?php

use App\Core\Router;
use App\Core\Response;

use App\Controllers\ProductController;
use App\Controllers\CategoryController;

return function (
    Router $router,
    ProductController $products,
    CategoryController $categories
): void {

    // ROOT INFO ENDPOINT
    $router->add('GET', '/', function (): void {
        Response::success([
            'name' => 'API Inventaris Barang',
            'version' => '1.0.0',
            'swagger_ui' => 'http://localhost:8000/swagger/',
            'endpoints' => [
                'GET /api/v1/categories',
                'GET /api/v1/categories/{id}',
                'POST /api/v1/categories',
                'PUT /api/v1/categories/{id}',
                'DELETE /api/v1/categories/{id}',
                'GET /api/v1/products',
                'GET /api/v1/products/{id}',
                'POST /api/v1/products',
                'PUT /api/v1/products/{id}',
                'DELETE /api/v1/products/{id}',
            ]
        ], 'Server API Inventaris berjalan dengan baik');
    });

    // PRODUCT CRUD
    $router->add('GET', '/api/v1/products', [$products, 'index']);
    $router->add('GET', '/api/v1/products/{id}', [$products, 'show']);
    $router->add('POST', '/api/v1/products', [$products, 'store']);
    $router->add('PUT', '/api/v1/products/{id}', [$products, 'update']);
    $router->add('DELETE', '/api/v1/products/{id}', [$products, 'destroy']);

    // CATEGORY CRUD
    $router->add('GET', '/api/v1/categories', [$categories, 'index']);
    $router->add('GET', '/api/v1/categories/{id}', [$categories, 'show']);
    $router->add('POST', '/api/v1/categories', [$categories, 'store']);
    $router->add('PUT', '/api/v1/categories/{id}', [$categories, 'update']);
    $router->add('DELETE', '/api/v1/categories/{id}', [$categories, 'destroy']);
};
