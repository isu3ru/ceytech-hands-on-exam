<?php

namespace App\Models;

use App\Enums\Role;
use App\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Authenticate user
     * @param $email
     * @param $password
     * @return bool
     */
    public function auth(string $email, string $password)
    {
        $user = $this->getUserByEmail($email);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
