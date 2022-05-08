<?php

namespace App;

use App\Helpers\Config;

class Model
{
    private static $instances = [];

    protected static $connection;

    public function __construct()
    {
        $config = new Config();

        $this->connection = new \PDO(
            'mysql:host=' . $config->config('host') . ';dbname=' . $config('database'),
            $config->config('username'),
            $config->config('password')
        );
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
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
