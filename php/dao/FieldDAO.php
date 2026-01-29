<?php
require_once __DIR__ . '/../lib/Database.php';
require_once __DIR__ . '/../entities/Field.php';

class FieldDAO {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }


    // function get, recuperer les valeurs 
    public function getFieldsByCollection(int $collectionId): array {
        $sql = "SELECT * FROM field WHERE collection_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$collectionId]);
        return array_map(fn($row) => new Field($row), $stmt->fetchAll());
    }

    public function create(Field $f): bool {
        $sql = "INSERT INTO field (collection_id, name, label, type, description, minimum, maximum, length, choiceList, geometry)
                VALUES (:collection_id, :name, :label, :type, :description, :minimum, :maximum, :length, :choiceList, :geometry)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':collection_id' => $f->collection_id,
            ':name' => $f->name,
            ':label' => $f->label,
            ':type' => $f->type,
            ':description' => $f->description,
            ':minimum' => $f->minimum,
            ':maximum' => $f->maximum,
            ':length' => $f->length,
            ':choiceList' => $f->choiceList,
            ':geometry' => $f->geometry,
        ]);
    }
}
