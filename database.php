<?php
require_once "config.php";

function add_diary() {

    $heading = htmlspecialchars($_POST['heading']);
    $message = htmlspecialchars($_POST['message']);
    
    $formData = "Title: $heading\nMessage: $message\n\n";
    $file = 'diary.txt';
    file_put_contents($file, $formData, FILE_APPEND | LOCK_EX);
}

function edit_diary() {
    $file = 'diary.txt';
    $updating_file = htmlspecialchars($_POST['updating_file']);
    file_put_contents($file, $updating_file);
}
