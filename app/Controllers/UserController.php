<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;
use App\Models\User;
use Rakit\Validation\Validator;

class UserController
{
    public function users()
    {
        $title = 'Create New User';

        $user = new User();
        $users = $user->all();

        ViewHelper::render('admin/users/index', compact('title', 'users'));
    }

    public function createUser()
    {
        $data = filter_input_array(INPUT_POST);
        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $validator = new Validator();
        $validation = $validator->validate($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            echo "<pre>";
            print_r($errors->firstOfAll());
            echo "</pre>";
            exit;
        }
        
        // insert user
        $user = new User($data['firstname'], $data['lastname'], $data['email'], $data['password'], $data['role']);
        $user->save();

        SessionHelper::setFlashData('success', 'User created successfully');

        // redirect to users
        UrlHelper::redirect('/admin/users');
    }

    public function edit()
    {
        $title = 'Edit User';

        $userId = filter_input(INPUT_GET, 'id');

        $userModel = new User();
        $users = $userModel->all();
        $user = $userModel->getUserById($userId);

        ViewHelper::render('admin/users/edit', compact('title', 'users', 'user'));
    }

    public function updateUser()
    {
        $data = filter_input_array(INPUT_POST);
        $userModel = new User;
        $user = $userModel->getUserById($data['id']);
        if (empty($user)) {
            UrlHelper::redirect('/admin/users');
        }

        // set password field id password is not empty
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // update user
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->update();

        SessionHelper::setFlashData('success', 'User updated successfully.');

        // redirect to users
        UrlHelper::redirect('/admin/users');
    }

    public function deleteUser()
    {
        $data = filter_input_array(INPUT_POST);

        $userModel = new User;
        $user = $userModel->getUserById($data['id']);
        if (empty($user)) {
            UrlHelper::redirect('/admin/users');
        }

        // delete user
        $user->delete();

        SessionHelper::setFlashData('success', 'User deleted successfully.');

        // redirect to users
        UrlHelper::redirect('/admin/users');
    }
}
