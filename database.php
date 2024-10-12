<?php

function add_diary() {

    $heading = htmlspecialchars($_POST['heading']);
    $message = htmlspecialchars($_POST['message']);
    
    $formData = "Title: $heading\nMessage: $message\n\n";
    $file = 'diary.txt';
    file_put_contents($file, $formData, FILE_APPEND | LOCK_EX);
}
