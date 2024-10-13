<?php
session_start();
$submitted = true; ?>
<html>
    <head>
        <title>Sign In</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="index.php">Go Back</a>
        <h3>Sign In</h3>
<?php
if(isset($_SESSION['username'])) { header('Location: index.php'); }
if(count($_POST) > 0){
    if(isset($_POST['username'][0]) && isset($_POST['password'][0])){
        $fp=fopen('users.csv.php','r');
        while(!feof($fp)){
            $line=fgets($fp);
            if(strstr($line,'<?php die() ?>') || strlen($line)<5) continue;
            $line=explode(',',trim($line));
            if($line[0]==$_POST['username'] && password_verify($_POST['password'],$line[1])){
                $_SESSION['username']=$_POST['username'];
                $submitted = false;
                header('Location: index.php');
            }
        }
        fclose($fp);
        if($submitted) { ?><strong>Invalid Credentials</strong><?php }

    }
}
?>
        <form method="POST">
            Username<br>
            <input autocomplete="off" type="text" name="username" required><br><br>
            Password<br>
            <input autocomplete="off" type="password" name="password" required><br><br>
            <button type="submit">Sign in</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </body>
</html>