<?php

/** @var $kinderen */
require_once "DBarray.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Kinderen</h1>
    <section>
        <?php foreach ($kinderen as $kind) { ?>
            <p class = "kind"><?= $kind['name'] ?></p>
        <?php } ?>
    </section>
</body>
</html>