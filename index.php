<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
    <title>Digital Diary</title>
</head>
<body>
<h2>Digital Diary</h2>
<?php
require_once "diary.php";
$current_page = getPageNumber();
$page_data = getDiaryPageData($current_page);
?>
    <form action="controller.php" method="post">
        <textarea id="editable-textarea" name="updating_file"><?php echo $page_data;?></textarea><br><br>
        <input type="hidden" name="controller" value="diary">
        <input type="hidden" name="current_page" value="<?php echo $current_page;?>">

        <input type="submit" name="prev_page" value="prev">
        <input type="submit" name="save_diary" value="save">
        <input type="submit" name="next_page" value="next">
    </form>
</body>
</html>
