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
    <form action="controller.php" method="post">
    <input type="hidden" name="controller" value="diary">
        <label for="name">Heading:</label>
        <input type="text" id="name" name="heading" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" name="submit_add_diary" value="Add To Diary">
    </form><br><br>
<?php
require_once "database.php";
$filePath = BASEURL.'/diary.txt';
$fileContents = file_get_contents($filePath);
?>
    <form action="controller.php" method="post">
        <input type="hidden" name="controller" value="diary">
        <textarea id="editable-textarea" name="updating_file" required><?php echo $fileContents;?></textarea><br><br>
        <input type="submit" name="submit_edit_diary" value="Change Diary">
    </form>
</body>
</html>
