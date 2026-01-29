<?php

// Représente une collection

class Collection {
    public int $id;
    public string $label;
    public string $description;
    public string $type;

    public function __construct(array $data = []) {
        // C'est pour initiasliser um table associ
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
