<?php

session_start();

$email = $_SESSION['login'];

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/** @var $db */
require_once "DB.php";

$id = $_GET['id'];

$query = "SELECT * FROM kinderen WHERE id = '$id'";
$result = mysqli_query($db, $query);

if ($result){
    $kind = mysqli_fetch_assoc($result);
    $name = $kind['name'];
}

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(mysqli_escape_string($db, $_POST['name']), ENT_QUOTES);

    if ($name == "") {
        $error = 'Naam mag niet leeg zijn';
    }

    if (!isset($error)) {
        $query = "UPDATE kinderen
                    SET name = '$name'
                    WHERE id = '$id'";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $error = 'Something went wrong in your database query: ' . mysqli_error($db);
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
    <h1>Nieuw kind toevoegen</h1>

    <?php if (isset($error)) { ?>
        <p><?= $error; ?></p>
    <?php } ?>

    <form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="name">Naam:</label><br>
            <input class = "text" id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
        </div>
        <div>
            <input id = "log" type="submit" name="submit" value="Veranderen"/>
        </div>
    </form>
</section>

</body>
</html>
