<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\UrlHelper;
use App\Helpers\ViewHelper;
use App\Models\User;
use Rakit\Validation\Validator;

class AuthController
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function login()
    {
        $title = 'Administrators Login';

        ViewHelper::render('admin/auth/login', compact('title'));
    }

    public function processAdminLogin()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $userModel = new User();
        $user = $userModel->getUserByUsername($username);

        if (empty($user) || !password_verify($password, $user->password)) {
            SessionHelper::setFlashData('error', 'Invalid username or password');
            UrlHelper::redirect('/admin/login');
        }

        SessionHelper::set('admin', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
        ]);

        UrlHelper::redirect('/admin');
    }

    public function processUserLogin()
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $userModel = new User();
        $user = $userModel->getUserByUsername($username);

        if (empty($user) || !password_verify($password, $user->password)) {
            SessionHelper::setFlashData('error', 'Invalid username or password');
            UrlHelper::redirect('/login');
        }

        SessionHelper::set('user', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
        ]);

        UrlHelper::redirect('/');
    }

    public function processUserRegistration()
    {
        $data = filter_var_array($_POST);

        $validator = new Validator();

        // make it
        $validation = $validator->make($data, [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'username' => 'required|min:6,alpha_num',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/',
            'confirm_password' => 'required|same:password'
        ], [
            'password' => 'Password is required and must be at least 8 characters with combination of at least 1
            uppercase letter, at least 1 number, lowercase letters and special
            characters',
        ]);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            SessionHelper::populateErrors($errors);
            SessionHelper::populateOldInput($data);
            UrlHelper::redirect('/register');
        }

        $user = new User();
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->registered_at = date('Y-m-d H:i:s');
        $user->save();

        SessionHelper::setFlashData('success', 'User created successfully');
        UrlHelper::redirect('/login');
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        SessionHelper::clean();
        UrlHelper::redirect('/admin/login');
    }

    public function processAdminLogout()
    {
        SessionHelper::remove('admin');
        SessionHelper::clean();
        SessionHelper::setFlashData('success', 'You have been logged out successfully.');
        UrlHelper::redirect('/admin/login');
    }

    public function processUserLogout()
    {
        SessionHelper::remove('user');
        SessionHelper::clean();
        SessionHelper::setFlashData('success', 'You have been logged out successfully.');
        UrlHelper::redirect('/');
    }
}
