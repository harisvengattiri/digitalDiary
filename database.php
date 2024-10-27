<?php
require_once "config.php";

function saveDiary($updated_file) {
    
    $updated_page = htmlspecialchars($updated_file);
    $processed_page = processPage($_POST['current_page']);
    
    $pages = $processed_page['pages'];
    $updating_index = $processed_page['updating_index'];
    $pages[$updating_index] = $updated_page;

    updateProcessedPage($pages);
}

function processPage($current_page) {
    $fileContents = file_get_contents(DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);
    $page_index = $current_page-1;
    return [
        'updating_index' => $page_index,
        'pages' => $pages
    ];
}

function updateProcessedPage($pages) {
    $new_file = implode(DELIMITER, $pages);
    file_put_contents(DIARY_FILE, $new_file);
}

function nextPage($current_page) {
    checkNextPageExists($current_page);
    $page = $current_page+1;
    return $page;
}

function prevPage($current_page) {
    checkPrevPageExists($current_page);
    $page = $current_page-1;
    return $page;
}

function checkPrevPageExists($current_page) {
    $fileContents = file_get_contents(DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);

    if (!isset($pages[$current_page-2])) {
        throw new Exception();
    }  
}

function checkNextPageExists($current_page) {
    $fileContents = file_get_contents(DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);

    if (!isset($pages[$current_page])) {
        addDelimiter();
    }
}

function addDelimiter() {
    file_put_contents(DIARY_FILE, DELIMITER, FILE_APPEND);
}
