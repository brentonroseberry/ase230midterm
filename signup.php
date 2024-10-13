<?php session_start();
if(isset($_SESSION['username'])) { header('Location: index.php'); }
if($submitted = false){ echo "Username in use";} //check this
$submitted = true;
if(count($_POST) > 0) {
    if(isset($_POST['username'][0]) && isset($_POST['password'][0])){
        $fp=fopen('users.csv.php','r');
        while(!feof($fp)) {
            $line = fgets($fp);
            if (strstr($line, '<?php die() ?>') || strlen($line) < 5) continue;
            $line = explode(',', trim($line));
            if($line[0]==$_POST['username']){
                header('location: signup.php');
                $submitted = false;
                die();
            }
        }
        fclose($fp);
        $fp=fopen('users.csv.php','a');
        fputs($fp,$_POST['username'].','.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
        fclose($fp);
        header('Location: signin.php');
    } else { echo 'Username and password are required'; }
}
?>
<html lang="en">
    <head>
        <title>Sign Up</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3>Sign Up</h3>
        <form method="POST">
            Username<strong>*</strong><br>
            <input autocomplete="off" type="text" name="username" required><br><br>
            Password<strong>*</strong><br>
            <input autocomplete="off" type="password" name="password" required><br><br>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="signin.php">Sign in</a></p>
    </body>
</html>