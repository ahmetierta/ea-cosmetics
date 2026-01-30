<?php

interface IProductRepository {
    public function insert(Product $product): bool;
    public function getAll(): array;
    public function getById(int $id): ?array;

    public function update(
        int $id,
        string $name,
        string $category,
        string $image,
        string $alt,
        string $description,
        float $price,
        ?float $salePrice,
        int $quantity
    ): bool;

    public function delete(int $id): bool;
}
