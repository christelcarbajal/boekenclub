<?php
/** @var $db */
require_once "DB.php";

if (isset($_POST['submit'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
    $naam = $_POST['name'];
    $school = $_POST['school'];
    $mail = $_POST['email'];

    if ($_POST['password'] == $_POST['password2']){
        $query = "INSERT INTO school (name)
                  VALUES ('$school')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result){
            $query = "SELECT * FROM school WHERE name = '$school'";
            $result = mysqli_query($db, $query) or die('Error: ' . $query);

            if ($result){
                $school = mysqli_fetch_assoc($result);
                $school_id = $school['id'];

                $query = "INSERT INTO docenten (name, mail, school_id, password)
                  VALUES ('$naam', '$mail', '$school_id', '$password')";
                $result = mysqli_query($db, $query) or die('Error: ' . $query);

                if ($result) {
                    header('Location: index.php');
                    exit;
                } else {
                    $error['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
                }
            }

        }




    }else{
        $errors['herhalen'] = 'Wachtwoord herhalen ging fout';
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
            <input class = "text" id="name" type="text" name="name"/>
        </div>
        <div>
            <label for="email">E-mail:</label><br>
            <input class = "text" id="email" type="email" name="email"/>
        </div>
        <div>
            <label for="school">School:</label><br>
            <input class = "text" id="school" type="text" name="school"/>
        </div>
        <div>
            <label for="password">Wachtwoord:</label><br>
            <input class = "text" id="password" type="password" name="password"/>
        </div>
        <div>
            <label for="password2">Wachtwoord herhalen:</label><br>
            <input class = "text" id="password2" type="password" name="password2"/>
            <span class="errors"><?= isset($errors['herhalen']) ? $errors['herhalen'] : '' ?></span>
        </div>
        <div>
            <input id = "log" type="submit" name="submit" value="Aanmelden"/>
        </div>
    </form>
</section>

</body>
</html>
