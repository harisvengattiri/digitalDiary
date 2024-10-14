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
            header('Location: '.BASEURL.'?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'?status=failed');
            exit();
        }
    }
}