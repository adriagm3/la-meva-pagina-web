<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $host = 'localhost';
            $port = '5432';
            $dbname = 'tdiw-a1';
            $user = 'tdiw-a1';
            $password = '2xCn5HDw';
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

            try {
                self::$connection = new PDO($dsn, $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En un entorn de producció, potser voldràs manejar aquest error d'una manera que no mostri informació sensible.
                echo "Error connectant a PostgreSQL: " . $e->getMessage();
                exit;
            }
        }
        return self::$connection;
    }
}

// Per utilitzar la connexió en un altre lloc de la teva aplicació:
// $db = Database::getConnection();
