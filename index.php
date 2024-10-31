<?php
require_once "diary.php";
$current_page = getPageNumber();
$page_data = getDiaryPageData($current_page);

$diary_template = file_get_contents("diary_template.html");

$diary_template = str_replace("{{page_data}}", htmlspecialchars($page_data), $diary_template);
$diary_template = str_replace("{{current_page}}", htmlspecialchars($current_page), $diary_template);

echo $diary_template;