<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <input type="submit" name="submit_add_diary" value="Save">
    </form>

<style>
#editableDiv {
    width: 80%;
    height: 400px;
    border: 1px solid #ccc;
    padding: 10px;
    overflow-y: scroll;
}
</style>
<?php
require_once "database.php";
$filePath = BASEURL.'/diary.txt';
$fileContents = file_get_contents($filePath);
?>
    <form action="controller.php" method="post">
    <input type="hidden" name="controller" value="diary">
        <div id="editableDiv" contenteditable="true">
            <?php echo "<pre>".htmlspecialchars($fileContents)."</pre>";?>
        </div>
        <input type="submit" name="submit_edit_diary" value="Save">
    </form>

</body>
</html>
