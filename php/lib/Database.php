<?php

// Connexion PDO à la base de données via fichier .conf

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            $config = self::readConfig();

            $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

            self::$connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }

        return self::$connection;
    }

    // Lire le fichier conf.
    private static function readConfig(): array {
        $path = __DIR__ . '/../../config/database.conf';

        if (!file_exists($path)) {
            throw new Exception("Fichier de configuration introuvable");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $config = [];

        foreach ($lines as $line) {
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $config[trim($key)] = trim($value);
            }
        }

        return $config;
    }
}
