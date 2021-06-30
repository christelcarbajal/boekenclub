<?php
/** @var $db */
require_once "DB.php";

if (isset($_POST['submit'])) {
    $password = htmlspecialchars(mysqli_escape_string($db, $_POST['password']), ENT_QUOTES) ;
    $password2 = htmlspecialchars(mysqli_escape_string($db, $_POST['password2']), ENT_QUOTES);
    $name = htmlspecialchars(mysqli_escape_string($db, $_POST['name']), ENT_QUOTES);
    $school = htmlspecialchars(mysqli_escape_string($db, $_POST['school']), ENT_QUOTES);
    $mail = htmlspecialchars(mysqli_escape_string($db, $_POST['email']), ENT_QUOTES);

    $errors = [];
    if ($name == "") {
        $errors['name'] = 'Naam mag niet leeg zijn';
    }
    if ($mail == "") {
        $errors['mail'] = 'E-mail mag niet leeg zijn';
    }
    if ($school == "") {
        $errors['school'] = 'School mag niet leeg zijn';
    }

    if($password == ""){
        $errors['password'] = 'Wachtwoord mag niet leeg zijn';
    }

    if($password2 == ""){
        $errors['password2'] = 'Wachtwoord herhalen mag niet leeg zijn';
    }

    if (empty($errors)) {
        $password3 = password_hash($password, PASSWORD_DEFAULT);
        $password4 = password_hash($password2, PASSWORD_DEFAULT);

        if ($password == $password2) {
            $query = "INSERT INTO school (name)
                  VALUES ('$school')";
            $result = mysqli_query($db, $query) or die('Error: ' . $query);

            if ($result) {
                $query = "SELECT * FROM school WHERE name = '$school'";
                $result = mysqli_query($db, $query) or die('Error: ' . $query);

                if ($result) {
                    $school = mysqli_fetch_assoc($result);
                    $school_id = $school['id'];

                    $query = "INSERT INTO docenten (name, mail, school_id, password)
                  VALUES ('$name', '$mail', '$school_id', '$password3')";
                    $result = mysqli_query($db, $query) or die('Error: ' . $query);

                    if ($result) {
                        header('Location: index.php');
                        exit;
                    } else {
                        $error['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
                    }
                }

            }

        } else {
            $errors['password2'] = 'Wachtwoord herhalen ging fout';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Aanmelden</title>
</head>
<body>
<section>
    <h1>Nieuwe School toevoegen</h1>

    <?php if (isset($error)) { ?>
        <p><?= $error['db']; ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="name">Naam:</label><br>
            <input class = "text" id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/><br>
            <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
        </div>
        <div>
            <label for="email">E-mail:</label><br>
            <input class = "text" id="email" type="email" name="email" value="<?= isset($mail) ? htmlentities($mail) : '' ?>"/><br>
            <span class="errors"><?= isset($errors['mail']) ? $errors['mail'] : '' ?></span>
        </div>
        <div>
            <label for="school">School:</label><br>
            <input class = "text" id="school" type="text" name="school" value="<?= isset($school) ? htmlentities($school) : '' ?>"/><br>
            <span class="errors"><?= isset($errors['school']) ? $errors['school'] : '' ?></span>
        </div>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input class = "text" id="password" type="password" name="password" value="<?= isset($password) ? htmlentities($password) : '' ?>"/><br>
            <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        </div>
        <div>
            <label for="password2">Wachtwoord herhalen:</label><br>
            <input class = "text" id="password2" type="password" name="password2" value="<?= isset($password2) ? htmlentities($password2) : '' ?>"/><br>
            <span class="errors"><?= isset($errors['password2']) ? $errors['password2'] : '' ?></span>
        </div>
        <div>
            <input id = "log" type="submit" name="submit" value="Aanmelden"/>
        </div>
    </form>
</section>

</body>
</html>
