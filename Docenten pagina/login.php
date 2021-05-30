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
        <p><?= $error; ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="email">E-mail:</label><br>
            <input class="text" id="email" type="email" name="email"/>
        </div>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input class="text" id="password" type="password" name="password"/>
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