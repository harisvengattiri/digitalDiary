<?php
define('BASEURL', 'http://localhost/digitalDiary');
$file = 'diary.txt';
$delimiter = '[next_page]';

function saveDiary($current_page) {
    global $file;
    global $delimiter;

    $fileContents = file_get_contents($file);
    $pages = explode($delimiter, $fileContents);
    $updated_page = htmlspecialchars($_POST['updating_file']);

    $page_index = $current_page-1;

    $pages[$page_index] = $updated_page;
    $new_file = implode($delimiter, $pages);
    file_put_contents($file, $new_file);
}

function nextPage($current_page) {
    global $file;
    global $delimiter;

    checkNextPageExists($current_page,$file,$delimiter);
    $page = $current_page+1;
    return $page;
}

function prevPage($current_page) {
    global $file;
    global $delimiter;

    checkPrevPageExists($current_page,$file,$delimiter);
    $page = $current_page-1;
    return $page;
}

function checkPrevPageExists($current_page,$file,$delimiter) {
    $fileContents = file_get_contents($file);
    $pages = explode($delimiter, $fileContents);

    if (!isset($pages[$current_page-2])) {
        throw new Exception();
    }  
}

function checkNextPageExists($current_page,$file,$delimiter) {
    $fileContents = file_get_contents($file);
    $pages = explode($delimiter, $fileContents);

    if (!isset($pages[$current_page])) {
        addDelimiter($file,$delimiter);
    }
}

function addDelimiter($file,$delimiter) {
    file_put_contents($file, $delimiter, FILE_APPEND);
}
