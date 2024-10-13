<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    die();
}
$post_id=$_GET['post_id'];
$posts = file_get_contents("items.json");
$posts = json_decode($posts, true);

unset($posts[$post_id]);
$posts = array_values($posts);
$posts = json_encode($posts, JSON_PRETTY_PRINT);
file_put_contents("items.json", $posts);
header('Location: index.php');
?>