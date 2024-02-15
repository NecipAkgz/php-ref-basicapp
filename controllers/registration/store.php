<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate user inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Invalid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password is required, at least 7 characters';
}

if (!empty($errors)) {
    return view('registration\create.view.php', [
        'errors' => $errors
    ]);
}


// check if the account exists
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

//* if yes, redirect to login page.
if ($user) {
    header('location: /');
    exit();
} else {
//* if no, create new account
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark the user as logged in
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}

