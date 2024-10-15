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


$delimiter = '[next_page]';
$pages = explode($delimiter, $fileContents);
// $rejoinedContent = implode($delimiter, $pages);
$total_pages = count($pages);

if(isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}
$page_data = $pages[$current_page-1];
?>
    <form action="controller.php" method="post">
        <textarea id="editable-textarea" name="updating_file" required><?php echo $page_data;?></textarea><br><br>
        <input type="hidden" name="controller" value="diary">
        <input type="hidden" name="current_page" value="<?php echo $current_page;?>">

        <input type="submit" name="prev_diary" value="prev">
        <input type="submit" name="save_diary" value="save">
        <input type="submit" name="next_diary" value="next">
    </form>

<?php
    var_dump($pages);
?>

</body>
</html>
