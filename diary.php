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
    return max(0, $current_page - 1);
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
    return $pages[$page_index] ?? '';
}

function getPageNumber() {
    return isset($_GET['page']) ? (int)$_GET['page'] : 1;
}

function goToNextPage($current_page) {
    return checkNextPageExists($current_page) ? $current_page + 1 : $current_page;
}

function goToPreviousPage($current_page) {
    return checkPrevPageExists($current_page) ? $current_page - 1 : $current_page;
}

function checkPrevPageExists($current_page) {
    $pages = getDiaryPages();
    return isset($pages[$current_page - 2]);
}

function checkNextPageExists($current_page) {
    $pages = getDiaryPages();
    if (!isset($pages[$current_page])) {
        addDelimiter();
        return true;
    }
    return isset($pages[$current_page]);
}

function addDelimiter() {
    file_put_contents(DIGITAL_DIARY_FILE, DELIMITER, FILE_APPEND);
}

function deleteSelectedPage() {
    $pages = getDiaryPages();
    $page_index = getPageIndex(getCurrentPage());
    if (isset($pages[$page_index])) {
        unset($pages[$page_index]);
        $pages = array_values($pages);
        saveDiary(prepareDiaryContent($pages));
    }
}
