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
            save_diary($_REQUEST);
            $current_page = $_POST['current_page'];
            header('Location: '.BASEURL.'?page='.$current_page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }

    if (isset($_REQUEST['next_page'])) {
        try {
            $page = nextPage();
            header('Location: '.BASEURL.'?page='.$page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }

    if (isset($_REQUEST['prev_page'])) {
        try {
            $page = prevPage();
            header('Location: '.BASEURL.'?page='.$page);
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }
}