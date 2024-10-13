<?php
require_once "config.php";

$file = 'diary.txt';

function add_diary() {
    global $file;

    $heading = htmlspecialchars($_POST['heading']);
    $message = htmlspecialchars($_POST['message']);
    
    $formData = "Title: $heading\nMessage: $message\n\n";
    file_put_contents($file, $formData, FILE_APPEND | LOCK_EX);
}

function edit_diary() {
    global $file;
    
    $updating_file = htmlspecialchars($_POST['updating_file']);
    file_put_contents($file, $updating_file);
}
