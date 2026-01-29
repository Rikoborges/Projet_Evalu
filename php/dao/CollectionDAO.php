<?php

// Accès aux données pour les collections

require_once __DIR__ . '/../lib/Database.php';
require_once __DIR__ . '/../entities/Collection.php';

class CollectionDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }
// get 
    public function getAll(): array {
        $sql = "SELECT * FROM collection";
        $stmt = $this->pdo->query($sql);
        return array_map(fn($row) => new Collection($row), $stmt->fetchAll());
    }

    public function getById(int $id): ?Collection {
        $sql = "SELECT * FROM collection WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        return $data ? new Collection($data) : null;
    }

    public function create(Collection $collection): bool {
        $sql = "INSERT INTO collection (label, description, type) VALUES (:label, :description, :type)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':label' => $collection->label,
            ':description' => $collection->description,
            ':type' => $collection->type
        ]);
    }

    public function update(Collection $collection): bool {
        $sql = "UPDATE collection SET label = :label, description = :description, type = :type WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':label' => $collection->label,
            ':description' => $collection->description,
            ':type' => $collection->type,
            ':id' => $collection->id
        ]);
    }
}
