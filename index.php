<?php
session_start();
$username = 'test';
$password = '1235';
$errorLog = [];
$expire = time() + 3600 * 24 * 365;
if (!empty($_POST['login'])) {
    if (!empty($_POST['username'])) {
        if (htmlspecialchars($_POST['username']) != $username) {
            $errorLog[] = 2;
        }
    } else {
        $errorLog[] = 20;
    }
    
    if (!empty($_POST['password'])) {
        if (htmlspecialchars($_POST['password']) != $password) {
            $errorLog[] = 3;
        }
    } else {
        $errorLog[] = 30;
    }

    if (!empty($_POST['keepMeLogIn'])) {
        if ((count($errorLog) == 0) && (htmlspecialchars($_POST['keepMeLogIn']) == true)) {
            setcookie('logged_in', $username, $expire);
        }
    }
} else {
    $errorLog[] = 100;
}
$errorLogCount = count($errorLog) . ' erreur(s)';
    if (!isset($_COOKIE['logged_in']) && count($errorLog) == 0) {
    $_SESSION['logged_in'] = $_POST['username'];
}

if (isset($_COOKIE['logged_in'])) {
    $_SESSION['logged_in'] = $_COOKIE['logged_in'];
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
            <input type="submit" name="login" />
        </form>
        <?php if (!empty($_POST['login'])) { ?>
            <p><?= (in_array(2, $errorLog) || in_array(20, $errorLog)) ? 'Veuillez entrer votre nom d\'utilisateur' : $username; ?></p>
            <p><?= (in_array(3, $errorLog) || in_array(30, $errorLog)) ? 'Veuillez entrer votre mot de passe' : $password; ?></p>
            <p><?= $errorLogCount; ?></p>
            <?php if ($errorLogCount != 0) { ?>
                <p>Code d'erreur : </p>
                <?php
                if (in_array(30, $errorLog)) {
                    echo 'Le formulaire est vide';
                } else {
                    ?>
                    <ul>
                        <?php foreach ($errorLog as $error) { ?>
                            <li><?= $error; ?></li>
                        <?php } ?>
                    </ul>
                <?php
                }
            }
        }
        ?>
                <?php if(!empty($_SESSION['logged_in'])){ ?>
                <p>connecté</p>
                <?php } else { ?>
                <p>déconnecté</p>
                <?php } ?>
    </body>
</html>