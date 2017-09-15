<?php

namespace App;

use PDO;

class DB
{
    private static $pdo;

    public static function init($config)
    {
        // Создаем PDO соединение
        self::$pdo = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        // Задаем режим выборки по умолчанию
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public static function selectOne($query)
    {
        $records = self::select($query);
        return array_shift($records);
    }

    public static function select($query)
    {
        $statement = self::$pdo->query($query);
        return $statement->fetchAll();
    }

    public static function affectingStatement($query)
    {
        $statement = self::$pdo->query($query);
        return $statement->rowCount();
    }

    public static function update($query)
    {
        $statement = self::$pdo->query($query);
        $statement->execute();
        return $statement->rowCount();
    }

    public static function insert($query)
    {
        $statement = self::$pdo->query($query);
        $success = $statement->execute();
        return $success ? self::$pdo->lastInsertId() : null;
    }
}