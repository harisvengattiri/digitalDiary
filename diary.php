<?php
require_once "config.php";

function updatePostedContentToDiaryPages() {
    $pages = getDiaryPages();
    $page_index = getPageIndex(getCurrentPage());
    $pages[$page_index] = sanitizeInput(getPostedContent());
    saveDiary(prepareDiaryContent($pages));
}

function getDiaryPages() {
    $fileContents = file_get_contents(DIGITAL_DIARY_FILE);
    return explode(DELIMITER, $fileContents);
}

function getPageIndex($current_page) {
    return $current_page-1;
}

function getCurrentPage() {
    return isset($_POST['current_page']) ? (int)$_POST['current_page'] : 1;
}

function getPostedContent() {
    return $_POST['updating_file'] ?? '';
}

function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function prepareDiaryContent(array $pages) {
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
    return $current_page+1;
}

function goToPreviousPage($current_page) {
    checkPrevPageExists($current_page);
    return $current_page-1;
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
    saveDiary(prepareDiaryContent($pages));
}
