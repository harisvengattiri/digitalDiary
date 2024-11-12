<?php
require_once "config.php";

function updatePostedContentToDiaryPages() {
    $pages = getDiaryPages();
    $page_index = getPageIndex(getCurrentPage());
    $pages[$page_index] = sanitizeInput(getPostedContent());
    $updated_content = prepareDiaryContent($pages);
    saveDiary($updated_content);
}

function getDiaryPages() {
    $fileContents = file_get_contents(DIGITAL_DIARY_FILE);
    $pages = explode(DELIMITER, $fileContents);
    return $pages;
}

function getPageIndex($current_page) {
    return $current_page-1;
}

function getCurrentPage() {
    return $_POST['current_page'];
}

function getPostedContent() {
    return $_POST['updating_file'] ?? '';
}

function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function prepareDiaryContent($pages) {
    return implode(DELIMITER, $pages);
}

function saveDiary($updated_content) {
    file_put_contents(DIGITAL_DIARY_FILE, $updated_content);
}

function getDiaryPageData($current_page) {
    $pages = getDiaryPages();
    $page_index = getPageIndex($current_page);
    return $pages[$page_index];
}

function getPageNumber() {
    if(isset($_GET['page'])) {
        return $_GET['page'];
    } else {
        return 1;
    }
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

function deleteSelectedPage() {
    $pages = getDiaryPages();
    $page_index = getPageIndex(getCurrentPage());
    unset($pages[$page_index]);
    $updated_content = prepareDiaryContent($pages);
    saveDiary($updated_content);
}
