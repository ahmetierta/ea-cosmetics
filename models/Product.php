<?php

class Product {
    private ?int $id;
    private string $name;
    private string $category;
    private string $image;
    private string $alt;
    private string $description;
    private float $price;
    private ?float $salePrice;
    private int $quantity;

    public function __construct(
        ?int $id,
        string $name,
        string $category,
        string $image,
        string $alt,
        string $description,
        float $price,
        ?float $salePrice,
        int $quantity
    ){
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->image = $image;
        $this->alt = $alt;
        $this->description = $description;
        $this->price = $price;
        $this->salePrice = $salePrice;
        $this->quantity = $quantity;
    }

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getCategory(): string { return $this->category; }
    public function getImage(): string { return $this->image; }
    public function getAlt(): string { return $this->alt; }
    public function getDescription(): string { return $this->description; }
    public function getPrice(): float { return $this->price; }
    public function getSalePrice(): ?float { return $this->salePrice; }
    public function getQuantity(): int { return $this->quantity; }
}
