<?php

namespace App\Models;

use App\Enums\Role;
use App\Model;

class User extends Model
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $role;

    public function __construct(string $firstname = '', string $lastname = '', string $email = '', string $password = '', string $role = '')
    {
        parent::__construct();

        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * Get the user by email address
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email): User
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
            $user = new User($result['firstname'], $result['lastname'], $result['email'], $result['password'], $result['role']);
            $user->id = $result['id'];
            return $user;
        }

        return null;
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

        if (password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    /**
     * Get user by id
     * @param $id
     * @return mixed
     */
    public function getUserById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
            $user = new User($result['firstname'], $result['lastname'], $result['email'], $result['password'], $result['role']);
            $user->id = $result['id'];
            return $user;
        }

        return null;
    }

    public function create($data)
    {
        $user = new User($data['firstname'], $data['lastname'], $data['email'], $data['password'], $data['role']);
        $user->save();

        return $user;
    }

    /**
     * Get all users
     * @return array
     */
    public function all()
    {
        $sql = 'SELECT * FROM users';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        $users = [];
        foreach ($results as $result) {
            $user = new User(
                $result['firstname'],
                $result['lastname'],
                $result['email'],
                $result['password'],
                $result['role']
            );
            $user->id = $result['id'];
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Save user
     *
     * @return void
     */
    public function save()
    {
        $sql = 'INSERT INTO users (firstname, lastname, email, password, role) 
        VALUES (:firstname, :lastname, :email, :password, :role)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->execute();

        $this->id = $this->connection->lastInsertId();

        return $this;
    }

    /**
     * Update user
     *
     * @return boolean
     */
    public function update(): bool
    {
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, 
        email = :email, password = :password, role = :role WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete()
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
