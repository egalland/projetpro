<?php
session_start();
$username = 'salu';
$errorlog = 0;
if(!empty($_POST['username']) && !empty($_POST['password'])){
    if($_POST['username'] == $username){
        $errorLog +=0;
    }else{
        $errorLog +=1;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>L o g i n</title>
    </head>
    <body>
        <form method="POST" action="index.php">
            <input type="text" name="username" />
            <input type="password" name="password" />
            <input type="checkbox" name="keepMeLogIn" />
            <input type="submit" />
        </form>
        <p><?= $errorlog == 0? $username: 'username'; ?></p>
    </body>
</html>
