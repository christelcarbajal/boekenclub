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
$school_id = $docent['school_id'];

if (isset($school_id)){
    $query = "SELECT * FROM kinderen WHERE school_id = '$school_id'";
    $result = mysqli_query($db, $query);

    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $kinderen[] = $row;
        }

        $query = "SELECT * FROM school WHERE id = '$school_id'";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            $school = mysqli_fetch_assoc($result);
            $school_name = $school['name'];
        }
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
    <title>Kinderen van <?= $school_name ?></title>
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
    <h1>Kinderen van <?= $school_name ?></h1>
</header>

    <section>
        <?php foreach ($kinderen as $kind) { ?>
            <a class = "block" href="overzicht.php?id=<?= $kind['id'] ?>"><p><?= $kind['name'] ?></p></a>
        <?php } ?>
    </section>
</body>
</html>