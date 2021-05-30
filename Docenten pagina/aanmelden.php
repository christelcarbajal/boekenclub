
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Aanmelden</title>
</head>
<body>
<section>
    <h1>Nieuwe Admin toevoegen</h1>

    <?php if (isset($error)) { ?>
        <p><?= $error['db']; ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="name">Naam:</label>
            <input class = "text" id="name" type="text" name="name"/>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input class = "text" id="email" type="email" name="email"/>
        </div>
        <div>
            <label for="last_name">School:</label>
            <input class = "text" id="last_name" type="text" name="last_name"/>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input class = "text" id="password" type="password" name="password"/>
        </div>
        <div>
            <label for="password2">Wachtwoord herhalen:</label>
            <input class = "text" id="password2" type="password" name="password2"/>
            <span class="errors"><?= isset($errors['herhalen']) ? $errors['herhalen'] : '' ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="Aanmelden"/>
        </div>
    </form>
</section>

</body>
</html>
