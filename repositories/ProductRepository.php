<?php
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/IProductRepository.php";

class ProductRepository implements IProductRepository {
    private PDO $conn;
    private string $table = "products"; 

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function insert(Product $product): bool {
    $sql = "INSERT INTO {$this->table}
            (name, category, image, alt, description, price, sale_price, quantity)
            VALUES (:n,:c,:img,:alt,:d,:p,:sp,:q)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ":n"   => $product->getName(),
        ":c"   => $product->getCategory(),
        ":img" => $product->getImage(),
        ":alt" => $product->getAlt(),
        ":d"   => $product->getDescription(),
        ":p"   => $product->getPrice(),
        ":sp"  => $product->getSalePrice(),
        ":q"   => $product->getQuantity(),
    ]);
    }


    public function getAll(): array {
    $sql = "SELECT id, name, category, image, alt, price, sale_price, quantity, description
            FROM {$this->table}
            ORDER BY id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
    }


    public function getById(int $id): ?array {
    $sql = "SELECT id, name, category, image, alt, description, price, sale_price, quantity
            FROM {$this->table}
            WHERE id = :id
            LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([":id" => $id]);
    $row = $stmt->fetch();
    return $row ?: null;
    }


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
    ): bool {
    $sql = "UPDATE {$this->table}
            SET name=:n, category=:c, image=:img, alt=:alt,
                description=:d, price=:p, sale_price=:sp, quantity=:q
            WHERE id=:id";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ":n" => $name,
        ":c" => $category,
        ":img" => $image,
        ":alt" => $alt,
        ":d" => $description,
        ":p" => $price,
        ":sp" => $salePrice,
        ":q" => $quantity,
        ":id" => $id
    ]);
    }


    public function delete(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }
}
