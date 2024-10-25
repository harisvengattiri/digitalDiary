<?php
define('BASEURL', 'http://localhost/digitalDiary');
define('DIARY_FILE', 'diary.txt');
define('DELIMITER', '[next_page]');

function saveDiary($updated_file) {
    
    $updated_page = htmlspecialchars($updated_file);
    $processed_page = processPage($_POST['current_page'], $file = DIARY_FILE, $delimiter = DELIMITER);
    
    $pages = $processed_page['pages'];
    $updating_index = $processed_page['updating_index'];
    $pages[$updating_index] = $updated_page;

    updateProcessedPage($pages, $file, $delimiter);
}

function processPage($current_page, $file, $delimiter) {
    $fileContents = file_get_contents($file);
    $pages = explode($delimiter, $fileContents);
    $page_index = $current_page-1;
    return [
        'updating_index' => $page_index,
        'pages' => $pages
    ];
}

function updateProcessedPage($pages, $file, $delimiter) {
    $new_file = implode($delimiter, $pages);
    file_put_contents($file, $new_file);
}

function nextPage($current_page, $file = DIARY_FILE, $delimiter = DELIMITER) {
    checkNextPageExists($current_page,$file,$delimiter);
    $page = $current_page+1;
    return $page;
}

function prevPage($current_page, $file = DIARY_FILE, $delimiter = DELIMITER) {
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
