<?php

namespace App;

class Model
{
    private static $instances = [];

    protected static $connection;

    public function __construct()
    {
        $this->connection = new \PDO(
            'mysql:host=' . $_ENV['DATABASE_HOSTNAME'] . ';dbname=' . $_ENV['DATABASE_NAME'],
            $_ENV['DATABASE_USERNAME'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * Return the instance of the model.
     *
     * @return Model
     */
    public static function getInstance(): Model
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    /**
     * Get the PDO connection.
     *
     * @return \PDO
     */
    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    /**
     * Execute query
     */
    public function execute(string $sql, array $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }
}
