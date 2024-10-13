<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    die();
}
if(count($_POST) > 0){
    $what = $_POST['what'];
    $where = $_POST['where'];
    $why = $_POST['why'];
    $author = $_SESSION['username'];
    $date = date("F d, Y");

    $newPost = array('Title'=> $what, 'Author' => $author, 'Date' => $date, 'Where'=> $where, 'Why' => $why);
    $currentPosts = json_decode(file_get_contents('items.json'), true);
    $currentPosts[] = $newPost;
    $updatedPosts = json_encode($currentPosts, JSON_PRETTY_PRINT);
    file_put_contents('items.json', $updatedPosts);
}
?>
<html lang="en">
    <head>
        <title>Create Post</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="index.php">Go Back</a>
        <h3>Create Post</h3>
        <form method="POST">
            What is it called?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="what" required><br><br>
            What platform is it on?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="where" required><br><br>
            Why?<strong>*</strong><br>
            <input autocomplete="off" type="text" name="why" required><br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>