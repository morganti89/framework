<?php

namespace App\Framework\Infra\Connection;

use PDO;
use App\Framework\Controllers\Controller;
use PDOStatement;

class DB
{
    private static ?DB $instance = null;
    private static $dbHost;
    private static $dbName;
    private static $dbUser;
    private static $dbPass;

    private PDO $connection;

    private static string $table;
    private static int $lastid;
    private static int $rowCount;

    private static PDOStatement $statement;

    private static string $sql;

    private static array $conditions;

    public function __construct()
    {

        self::$dbHost = getenv("DB_HOST");
        self::$dbName = getenv("DB_NAME");
        self::$dbUser = getenv("DB_USER");
        self::$dbPass = getenv("DB_PASSWORD");

        $this->connection = new PDO(
            "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
            self::$dbUser,
            self::$dbPass
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public static function getInstance(): DB|null
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnetion(): PDO|null
    {
        return $this->connection;
    }

    public static function query(...$a): DB|null
    {
        self::$statement = self::getInstance()
            ->getConnetion()
            ->query("SELECT * FROM " . self::$table);

        return self::$instance;
    }

    public  static function get(): DB|null
    {
        self::$sql = "SELECT * FROM " . self::$table;
        return self::$instance;
    }

    public  static function where($condititon): DB|null
    {

        self::$conditions = $condititon;
        $key = key(self::$conditions);
        self::$sql .=  " WHERE " . "$key=:$key";
        return self::$instance;
    }

    public static function prepare(): DB|null
    {
        self::$statement = self::getInstance()
            ->getConnetion()
            ->prepare(self::$sql);

        foreach (self::$conditions as $key => $value) {
            self::$statement->bindValue($key, $value);
        }
        self::$statement->execute();

        return self::$instance;
    }

    public static function fetch(): mixed
    {
        return self::$statement->fetch(PDO::FETCH_ASSOC);
    }

    public function all(): array
    {
        return self::$statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId(): int
    {
        return self::getInstance()->getConnetion()->lastInsertId();
    }

    public static function table($tableName): DB
    {
        self::$table = $tableName;
        return self::$instance;
    }

    public static function create(array $data): DB
    {
        $keys = self::getInstance()->parseKeys($data);
        $key = $keys['key'];
        $bindValues = $keys['bind'];

        $sql = "INSERT INTO " . self::$table . " ($key) VALUES ($bindValues)";
        $stmt = self::getInstance()->getConnetion()->prepare($sql);

        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return self::$instance;
    }
    public static function update(array $data)
    {
        $keys = self::getInstance()->parseKeys($data);

        $sql = "UPDATE " . self::$table .
            " SET " . $keys['update'] . "  WHERE id=:id";
        $stmt = self::getInstance()->getConnetion()->prepare($sql);

        foreach ($data as $key => $value) {
            echo $key . " " . $value;
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        self::$rowCount = $stmt->rowCount();
        return self::getInstance();
    }

    public static function delete(array $data)
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        $stmt = self::getInstance()->getConnetion()->prepare($sql);
        $stmt->bindValue(1, $data["id"]);
        $stmt->execute();
        self::$rowCount = $stmt->rowCount();
        return self::getInstance();
    }

    public function rowCount(): int
    {
        return self::$rowCount;
    }

    public function lastid()
    {
        return self::$lastid;
    }

    private function parseKeys(array $data): array
    {
        $keys['key'] = '';
        $keys['bind'] = '';
        $keys['update'] = '';
        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $keys['key'] .= "$key,";
            $keys['bind'] .= ":$key,";
            $keys["update"] .= "$key=:$key,";
        }
        $keys['key'] = substr($keys['key'], 0, -1);
        $keys['bind'] = substr($keys['bind'], 0, -1);
        $keys['update'] = substr($keys['update'], 0, -1);
        return $keys;
    }

    private function parseValues($data): array
    {
        $values = [];
        foreach ($data as $key => $value) {
            if ($key == 'id') continue;
            $values[] = $value;
        }
        return $values;
    }

    private function parseClassController(): object|null
    {
        $traces = debug_backtrace();
        $class = null;
        foreach ($traces as $key => $trace) {
            if (isset($trace['class']) && isset($trace['object'])) {
                if ($trace['object'] instanceof Controller) {
                    $class = $trace['object'];
                    break;
                }
            }
        }
        return $class;
    }

    private function queryById(array $conditions, string $table): array|null
    {
        $key = key($conditions[0]);
        $q = "= ?";
        $v = [];
        if (is_array($conditions[0][$key])) {
            $c = "";
            for ($i = 0; $i < count($conditions[0][$key]); $i++) {
                $c .= "?,";
            }
            $c = substr($c, 0, -1);
            $q = "in ($c)";
        }

        $sql = "SELECT * FROM $table WHERE $key " . $q;

        $stmt = self::getInstance()->getConnetion()->prepare($sql);
        if (is_array($conditions[0][$key])) {
            for ($i = 1; $i <= count($conditions[0][$key]); $i++) {
                $stmt->bindValue($i, $conditions[0][$key][$i - 1], PDO::PARAM_INT);
            }
        } else {
            $stmt->bindValue(1, $conditions[0][$key], PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
