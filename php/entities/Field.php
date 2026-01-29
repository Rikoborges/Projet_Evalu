<?php

// Un champ personnalisé d'une collection 

class Field {
    public int $id;
    public int $collection_id;
    public string $name;
    public string $label;
    public string $type;
    public ?string $description = null;
    public ?int $minimum = null;
    public ?int $maximum = null;
    public ?int $length = null;
    public ?string $choiceList = null;
    public ?string $geometry = null;

    public function __construct(array $data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
