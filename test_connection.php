<?php
require_once __DIR__ . '/php/lib/Database.php';

try {
    $pdo = Database::getConnection();
    echo "✅ Conexão bem-sucedida com o banco de dados!";
} catch (Exception $e) {
    echo "❌ Erro de conexão: " . $e->getMessage();
}

