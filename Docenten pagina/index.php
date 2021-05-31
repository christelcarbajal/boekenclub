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

$docent = mysqli_fetch_assoc($result);
$school = $docent['school'];

if (isset($school)){
    $query = "SELECT * FROM kinderen WHERE school = '$school'";
    $result2 = mysqli_query($db, $query);

    while ($row = mysqli_fetch_assoc($result2)){
        $kinderen[] = $row;
    }

    if (empty($kinderen)){
        header("Location: addKind.php");
        exit;
    }

    mysqli_close($db);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kinderen van <?= $school ?></title>
    <link rel="stylesheet" type="text/css" href="css/style3.css">
</head>
<body>
<header>
    <a id = logout href = logout.php>
    <div>
        Log <?= $email ?> uit
    </div>
    </a>
    <a id = logout href = addKind.php>
        <div>
            Voeg kind toe
        </div>
    </a>
    <h1>Kinderen van <?= $school ?></h1>
</header>

    <section>
        <?php foreach ($kinderen as $kind) { ?>
            <a href="overzicht.php?id=<?= $kind['id'] ?>"><p class = "kind"><?= $kind['name'] ?></p></a>
        <?php } ?>
    </section>
</body>
</html>