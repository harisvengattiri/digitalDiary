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
require_once "database.php";
$filePath = BASEURL.'/diary.txt';
$fileContents = file_get_contents($filePath);
?>
    <form action="controller.php" method="post">
        <input type="hidden" name="controller" value="diary">
        <textarea id="editable-textarea" name="updating_file" required><?php echo $fileContents;?></textarea><br><br>

        <input type="submit" name="prev_diary" value="prev">
        <input type="submit" name="save_diary" value="save">
        <input type="submit" name="next_diary" value="next">
    </form>
</body>
</html>
