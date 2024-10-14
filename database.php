<?php
require_once "config.php";

$file = 'diary.txt';

function save_diary() {
    global $file;
    
    $updating_file = htmlspecialchars($_POST['updating_file']);
    file_put_contents($file, $updating_file);
}
