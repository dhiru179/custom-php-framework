<?php

namespace app\core;

class Database
{

    public \PDO $pdo;

    public function __construct($configEnv)
    {
        $configEnv['db']['DB_CONNECTION'];
        $servername = $configEnv['db']['DB_HOST'];
        $configEnv['db']['DB_PORT'];
        $myDB = $configEnv['db']['DB_DATABASE'];
        $username = $configEnv['db']['DB_USERNAME'];
        $password = $configEnv['db']['DB_PASSWORD'];
        // try {

        // exit;
        $this->pdo = new \PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
        // set the PDO error mode to exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        // } catch (\PDOException $e) {
        //     echo "Connection failed: " . $e->getMessage();
        // }
    }

    public function applyMigrations()
    {
        $storeMigration = [];
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR . '/migration');
        $toAppliedMigrations = array_diff($files, $appliedMigrations);
        foreach ($toAppliedMigrations as $key => $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR . '/migration' . '/' . $value;
            $className = pathinfo($value, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Apply migration $value");
            $instance->up();
            $this->log("Applied migrations $value");
            $storeMigration[] = $value;
        }
        if (!empty($storeMigration)) {
            $this->saveMigrations($storeMigration);
        } else {
            $this->log("All Migrations Are Applied");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations(id INT AUTO_INCREMENT PRIMARY KEY,migration VARCHAR(255),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration from migrations");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function saveMigrations(array $storeMigration)
    {

        $storeTableName = implode(',', array_map(fn ($m) => "('$m')", $storeMigration));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $storeTableName");
        $statement->execute();
    }

    public function log($message)
    {
        echo '[' . date('y-m-d H:i:s') . '] - ' . $message.PHP_EOL;
    }
}
