<?php

session_start();

$email = $_SESSION['login'];

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/** @var $db */
require_once "DB.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM kinderen WHERE id = '$id'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    if ($result) {
        $kind = mysqli_fetch_assoc($result);

        $school_id = $kind['school_id'];

        $query = "SELECT * FROM school WHERE id = '$school_id'";
        $result = mysqli_query($db, $query) or die ('Error: ' . $query);

        if ($result){
            $school = mysqli_fetch_assoc($result);

            if (isset($_POST['submit'])) {
                $query = "DELETE FROM kinderen WHERE id = " . mysqli_escape_string($db, $_POST['id']);
                mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

                mysqli_close($db);

                header("Location: index.php");
                exit;
            }

            if (isset($_POST['submit2'])) {
                $query = "DELETE FROM kinderen WHERE school_id = " . mysqli_escape_string($db, $_POST['id2']);
                mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

                mysqli_close($db);

                header("Location: index.php");
                exit;
            }
        }


    }


}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Delete - <?= $kind['name'] ?></title>
</head>
<body>
<section>
    <h2>Verwijder - <?= $kind['name'] ?></h2>
    <form action="" method="post">
        <p>
            Weet u zeker dat u "<?= $kind['name'] ?>" wilt verwijderen? Alle gegevens van <?= $kind['name'] ?> zullen verloren gaan.
        </p>
        <input type="hidden" name="id" value="<?= $kind['id'] ?>"/>
        <input id = "log" type="submit" name="submit" value="Verwijder alleen <?= $kind['name'] ?>"/>
    </form>

    <h2 id = "warning" >Of verwijder - alle kinderen</h2>
    <form action="" method="post">
        <p>
            Weet u zeker dat u "Alle kinderen van <?= $school['name'] ?>" wilt verwijderen? Alle gegevens van de kinderen zullen verloren gaan, maar uw account blijft wel bestaan.
        </p>
        <input type="hidden" name="id2" value="<?= $school['id'] ?>"/>
        <input id = "log" type="submit" name="submit2" value="Verwijder alle kinderen van <?= $school['name'] ?>"/>
    </form>
</section>

</body>
</html>

