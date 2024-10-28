<?php
require_once "config.php";

function saveDiary($content) {
    
    $content = htmlspecialchars($content);
    $processed_page = processPage(getCurrentPage());
    
    $pages = $processed_page['pages'];
    $updating_index = $processed_page['updating_index'];
    $pages[$updating_index] = $content;

    updateProcessedPage($pages);
}

function getCurrentPage() {
    return $_POST['current_page'];
}

function processPage($current_page) {
    $fileContents = file_get_contents(DIGITAL_DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);
    $page_index = $current_page-1;
    return [
        'updating_index' => $page_index,
        'pages' => $pages
    ];
}

function updateProcessedPage($pages) {
    $new_file = implode(DELIMITER, $pages);
    file_put_contents(DIGITAL_DIARY_FILE, $new_file);
}

function goToNextPage($current_page) {
    checkNextPageExists($current_page);
    $page = $current_page+1;
    return $page;
}

function goToPreviousPage($current_page) {
    checkPrevPageExists($current_page);
    $page = $current_page-1;
    return $page;
}

function checkPrevPageExists($current_page) {
    $fileContents = file_get_contents(DIGITAL_DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);

    if (!isset($pages[$current_page-2])) {
        throw new Exception();
    }  
}

function checkNextPageExists($current_page) {
    $fileContents = file_get_contents(DIGITAL_DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);

    if (!isset($pages[$current_page])) {
        addDelimiter();
    }
}

function addDelimiter() {
    file_put_contents(DIGITAL_DIARY_FILE, DELIMITER, FILE_APPEND);
}
