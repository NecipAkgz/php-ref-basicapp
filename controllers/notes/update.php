<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

// find the corresponding note
$note = $db->query(
    'SELECT * FROM notes where id = :id',
    ['id' => $_POST['id']]
)->findOrFail();

// authorize that the note belongs to the current user
authorize($note['user_id'] !== $currentUserId);

// validate the form data
$errors = [];
if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body is required';
}

// if no errors, update the note
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query(
    'UPDATE notes SET body = :body WHERE id = :id', [
        'id' => $_POST['id'],
        'body' => $_POST['body']
    ]
);

// redirect back to the index
header('location: /notes');