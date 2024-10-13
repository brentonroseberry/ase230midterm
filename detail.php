<html lang="en">
    <a href="index.php">Go Back</a><br>
    <?php
    session_start();
    $post_id=$_GET['post_id'];
    if(isset($_SESSION['username'])){?><a href="delete.php?post_id=<?=$post_id?>">Remove Post</a><br><?php }
    if(isset($_SESSION['username'])){?><a href="edit.php?post_id=<?=$post_id?>">Edit Post</a><?php }
    $posts = file_get_contents("items.json");
    $posts = json_decode($posts, true);
    ?>
    <head>
        <title>Roseberry Midterm</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <h2><?=$posts[$post_id]["Title"]?></h2>
    <h4>By: <?=$posts[$post_id]["Author"]?></h4>
    <h4>Recommended on: <?=$posts[$post_id]["Date"]?></h4>

    <p>Found on: <?=$posts[$post_id]["Where"]?></p>
    <p><?=$posts[$post_id]["Why"]?></p>
    </body>
</html>
