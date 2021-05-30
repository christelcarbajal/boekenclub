<?php

/** @var $db */
require_once "DB.php";

$query = "SELECT * FROM kinderen";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)){
    $kinderen[] = $row;
}

mysqli_close($db);