<?php

require base_path('Validator.php');

$config = require base_path('config.php');
$db     = new Database($config['database']);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body of at least 1 character is required';
    }

    if (empty($errors)) {
        $note = ['body' => $_POST['body'], 'user_id' => 1];
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', $note);
    }
}

view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors'  => $errors
]);
