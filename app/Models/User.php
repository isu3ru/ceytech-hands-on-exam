<?php

namespace App\Models;

use App\Model;

class User extends Model
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $username;
    public string $password;
    public string $role;
    public string $registered_at;

    public function __construct(string $firstname = '', string $lastname = '', string $username = '', string $email = '', string $password = '', string $role = '', string $registered_at = '')
    {
        parent::__construct();

        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->registered_at = $registered_at;
    }

    /**
     * Get the user by username
     *
     * @param string $username
     * @return ?User
     */
    public function getUserByUsername($username): ?User
    {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result) {
            $user = new User($result['firstname'], $result['lastname'], $result['username'], $result['email'], $result['password'], $result['role'], $result['registered_at']);
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
    public function auth(string $username, string $password)
    {
        $user = $this->getUserByUsername($username);

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
            $user = new User($result['firstname'], $result['lastname'], $result['username'], $result['email'], $result['password'], $result['role'], $result['registered_at']);
            $user->id = $result['id'];
            return $user;
        }

        return null;
    }

    public function create($data)
    {
        $user = new User($data['firstname'], $data['lastname'], $data['username'], $data['email'], $data['password'], $data['role'], $data['registered_at']);
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
                $result['username'],
                $result['email'],
                $result['password'],
                $result['role'],
                $result['registered_at'],
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
        $sql = 'INSERT INTO users (firstname, lastname, username, email, password, role, registered_at) 
        VALUES (:firstname, :lastname, :username, :email, :password, :role, :registered_at)';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':registered_at', $this->registered_at);
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
        username = :username, email = :email, password = :password, role = :role, registered_at = :registered_at 
        WHERE id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':registered_at', $this->registered_at);
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
