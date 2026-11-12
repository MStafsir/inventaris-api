<?php

namespace App\Controllers;

use App\Core\Response;
use App\Services\ProductService;

class ProductController
{
    public function __construct(
        private ProductService $service
    ) {}

    public function index(): void
    {
        $filters = [
            'search' => $_GET['search'] ?? null,
            'category_id' => $_GET['category_id'] ?? null
        ];

        Response::success(
            $this->service->getAll($filters),
            'Daftar produk berhasil diambil'
        );
    }

    public function show(int $id): void
    {
        Response::success(
            $this->service->getById($id)
        );
    }

    public function store(): void
    {
        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (!is_array($data) || array_is_list($data)) {
            Response::error('JSON object tidak valid', 400);
        }

        $product = $this->service->create($data);

        Response::success(
            $product,
            'Produk berhasil ditambahkan',
            201
        );
    }

    public function update(int $id): void
    {
        $data = json_decode(
            file_get_contents('php://input'),
            true
        );

        if (!is_array($data) || array_is_list($data)) {
            Response::error('JSON object tidak valid', 400);
        }

        $product = $this->service->update($id, $data);

        Response::success(
            $product,
            'Produk berhasil diperbarui'
        );
    }

    public function destroy(int $id): void
    {
        $this->service->delete($id);

        Response::json(null, 204);
    }
}
