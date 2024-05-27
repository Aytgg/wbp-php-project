<?php

namespace Project\Classes;

require_once __DIR__ . '/envloader.php';

use PDO;
use PDOException;

class DB
{
    private $conn;
    private const HOST = $_ENV['HOST'];
    private const DB = $_ENV['DB'];
    private const USER = $_ENV['USER'];
    private const PW = $_ENV['PW'];
    private const CHARSET = $_ENV['CHARSET'];

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
            throw new PDOException("PDO DB Connection Error: " . $e->getMessage());
            
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
