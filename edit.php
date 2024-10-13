<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    die();
}
$post_id=$_GET['post_id'];
$posts = file_get_contents("items.json");
$posts = json_decode($posts, true);

$preWhat = $posts[$post_id]['Title'];
$preWhere = $posts[$post_id]['Where'];
$preWhy = $posts[$post_id]['Why'];

if(count($_POST) > 0){
    $what = $_POST['what'];
    $where = $_POST['where'];
    $why = $_POST['why'];
    $author = $_SESSION['username'];
    $date = date("F d, Y");

    $posts[$post_id]['Title'] = $what;
    $posts[$post_id]['Author'] = $author;
    $posts[$post_id]['Date'] = $date;
    $posts[$post_id]['Why'] = $why;
    $posts[$post_id]['Where'] = $where;

    $posts = json_encode($posts, JSON_PRETTY_PRINT);
    file_put_contents("items.json", $posts);
}

?>
<html lang="en">
    <head>
        <title>Edit Post</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="detail.php?post_id=<?= $post_id ?>">Go Back</a>
        <h3>Edit Post</h3>
        <form method="POST">
            What is it called?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="what" value="<?= $preWhat ?>" required><br><br>
            What platform is it on?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="where" value="<?= $preWhere ?>" required><br><br>
            Why?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="why" value="<?= $preWhy ?>" required><br>
            <button type="submit">Edit</button>
        </form>
    </body>
</html>
