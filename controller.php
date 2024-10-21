<?php
require_once("database.php");

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
            $updated_file = $_POST['updating_file'];
            saveDiary($current_page, $updated_file);
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
            $page = nextPage($current_page);
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
            $page = prevPage($current_page);
            header('Location: '.BASEURL.'?page='.$page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }
}