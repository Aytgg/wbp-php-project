<?php

namespace Project\Classes;

use PDO;
use PDOException;

class DB
{
    private $conn;
    private const HOST = "localhost";
    private const DB = "halkdiyorkixyz_projectofwbp";
    private const USER = "halkdiyorkixyz_projectofwbp";
    private const PW = ")n5JKK1zg@70";
    private const CHARSET = "utf8mb4";

    public function connect()
    {
        $conn = null;

        try {
            $dsn = 'mysql:host=' . self::HOST
                . ';dbname=' . self::DB
                . ';charset=' . self::CHARSET;
            $conn = new PDO($dsn, self::USER, self::PW);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET COLLATION_CONNECTION = 'utf8mb4_turkish_ci'");

            return $conn;
        } catch (PDOException $e) {
            echo 'DB Connection Error: ' . $e->getMessage();
        }


        /*$stmt = $conn->prepare("SELECT * FROM users");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);*/
    }

    public function query($sql, array $params)
    {
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute($params);
        return $result;
    }

    public function fetch($sql, array $params)
    {
        return $this->query($sql, $params)->fetch();
    }

    public function fetchAll($sql, $params = array())
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    public function exec($sql)
    {
        return $this->conn->exec($sql);
    }
}
