<?php
session_start();
$posts = file_get_contents("items.json");
$posts = json_decode($posts, true);
function printPosts($i, $blog_post){?>
    <div>
        <h3><a href="detail.php?post_id=<?= $i ?>"><?= $blog_post["Title"]?></a></h3>
        <h4>By: <?= $blog_post["Author"]?></h4>
        <br>
    </div>
<?php } ?>

<html lang="en">
    <head>
        <title>Roseberry Midterm</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Welcome <?php if(!isset($_SESSION['username'])) { echo ""; }
            else { echo $_SESSION['username']; }?></h1>
        <?php if(!isset($_SESSION['username'])){?><a href="signin.php">Sign In</a><br><?php }?>
        <?php if(isset($_SESSION['username'])){?><a href="signout.php">Sign Out</a><br><?php }?>
        <h2>Stuff I need to play or watch:</h2>
        <?php if(isset($_SESSION['username'])){?><a href="create.php">Recommend thing</a><?php }?>
        <?php for($i=0;$i<count($posts);$i++){ printPosts($i, $posts[$i]); }?>
    </body>
</html> <!-- By Brenton Roseberry -->