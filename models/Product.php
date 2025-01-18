<?php

namespace Models;

use Core\Model;

class Product extends Model {
    public function createProduct($name, $description, $price, $status = 'available') {
        $sql = "INSERT INTO products (name, description, price, status) VALUES (:name, :description, :price, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':status' => $status,
        ]);
        return $this->db->lastInsertId();
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $description, $price, $status) {
        $sql = "UPDATE products SET name = :name, description = :description, price = :price, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':status' => $status,
        ]);
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}