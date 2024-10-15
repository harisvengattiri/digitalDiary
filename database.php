<?php
require_once "config.php";

$file = 'diary.txt';
$delimiter = '[next_page]';

function save_diary() {
    global $file;
    
    $updating_file = htmlspecialchars($_POST['updating_file']);
    file_put_contents($file, $updating_file);
}

function nextPage() {
    $current_page = $_POST['current_page'];
    checkNextPageExists($current_page);
    $page = $current_page+1;
    return $page;
}

function checkNextPageExists($current_page) {
    global $file;
    global $delimiter;

    $fileContents = file_get_contents($file);
    $pages = explode($delimiter, $fileContents);

    if (!isset($pages[$current_page])) {
        add_delimiter();
    }
}

function add_delimiter() {
    global $file;
    global $delimiter;

    file_put_contents($file, $delimiter, FILE_APPEND);
}
