<?php

$config = require('config.php');
$db     = new Database($config['database']);

$heading = 'Create Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $note = [
    'body'    => $_POST['body'],
    'user_id' => 1
  ];
  $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', $note);
}

require 'views/note-create.view.php';
