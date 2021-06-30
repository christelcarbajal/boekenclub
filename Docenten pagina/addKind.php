<?php

session_start();

$email = $_SESSION['login'];

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/** @var $db */
require_once "DB.php";

$query = "SELECT * FROM docenten WHERE mail = '$email'";
$result = mysqli_query($db, $query);

if ($result){
    $docent = mysqli_fetch_assoc($result);
    $school_id = $docent['school_id'];
}

if (isset($_POST['submit'])) {
    $naam = $_POST['name'];
        $query = "INSERT INTO kinderen (name, school_id)
                  VALUES ('$naam', '$school_id')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $error['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }else{
        $errors['herhalen'] = 'Wachtwoord herhalen ging fout';
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
    <h1>Nieuw kind toevoegen</h1>

    <?php if (isset($error)) { ?>
        <p><?= $error['db']; ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="name">Naam:</label><br>
            <input class = "text" id="name" type="text" name="name"/>
        </div>
        <div>
            <input id = "log" type="submit" name="submit" value="Aanmaken"/>
        </div>
    </form>
</section>

</body>
</html>
