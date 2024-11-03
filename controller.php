<?php
require_once("diary.php");

$controller = $_REQUEST['controller'];
switch ($controller) {
    case 'diary':
        handleDiary();
        break;
}

function handleDiary() {
    if (isset($_REQUEST['save_diary'])) {
        try {
            $current_page = $_POST['current_page'];
            updatePostedContentToDiaryPages();
            header('Location: '.BASEURL.'?page='.$current_page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }

    if (isset($_REQUEST['next_page'])) {
        try {
            $current_page = $_POST['current_page'];
            $page = goToNextPage($current_page);
            header('Location: '.BASEURL.'?page='.$page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }

    if (isset($_REQUEST['prev_page'])) {
        try {
            $current_page = $_POST['current_page'];
            $page = goToPreviousPage($current_page);
            header('Location: '.BASEURL.'?page='.$page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }

    if (isset($_REQUEST['delete_page'])) {
        try {
            $current_page = $_POST['current_page'];
            deleteSelectedPage();
            header('Location: '.BASEURL.'?page='.$current_page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }
}