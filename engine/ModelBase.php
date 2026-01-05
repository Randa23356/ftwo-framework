<?php

namespace Engine;

use PDO;
use PDOException;

class ModelBase
{
    protected static $db;

    public function __construct()
    {
        if (!self::$db) {
            $this->connect();
        }
    }

    private function connect()
    {
        $config = \Engine\Boot::config('database');
        
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            self::$db = new PDO($dsn, $config['username'], $config['password']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Database Connection Error: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        $stmt = self::$db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetch($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }
}
