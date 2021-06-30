<?php

session_start();

/** @var $db */
require_once "DB.php";
$login = false;

if (isset($_POST['submit'])) {
    $email = htmlspecialchars(mysqli_escape_string($db, $_POST['email']), ENT_QUOTES);
    $password = htmlspecialchars(mysqli_escape_string($db, $_POST['password']), ENT_QUOTES) ;

    //Get record from DB based on their mail
    $query = "SELECT * FROM docenten WHERE mail='$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $login = true;
        } else {
            $error = "Onjuiste inloggegevens";
        }
    } else {
        $error = "Onjuiste inloggegevens";
    }
    if (!isset($error)) {
        $_SESSION['login'] = $email;
    }
}


if (isset($_SESSION['login'])) {
    header("Location: index.php ");
    exit;
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<section>
    <h1>Login</h1>

    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="email">E-mail:</label><br>
            <input class="text" id="email" type="email" name="email" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
        </div>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input class="text" id="password" type="password" name="password" value="<?= isset($password) ? htmlentities($password) : '' ?>"/>
        </div>
        <div>
            <input id = "log" type="submit" name="submit" value="Login"/>
        </div>

    </form>

    <div id = "link">
        <a href="../Docenten%20pagina/aanmelden.php">Of maak een account aan!</a>
    </div>
</section>




</body>
</html>