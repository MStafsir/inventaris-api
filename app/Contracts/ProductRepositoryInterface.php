<?php

namespace App\Contracts;

interface ProductRepositoryInterface
{
    public function getAll(array $filters = []): array;

    public function findById(int $id): ?array;

    public function create(array $data): array;

    public function update(int $id, array $data): ?array;

    public function delete(int $id): bool;
}
