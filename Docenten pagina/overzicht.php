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

$kind = mysqli_fetch_assoc($result);

$naam = $kind['name'];

$LV1goed = $kind['LV1 goed'];
$LV1fout = 5 - $LV1goed;

$LV2goed = $kind['LV2 goed'];
$LV2fout = 5 - $LV2goed;

$LV3goed = $kind['LV3 goed'];
$LV3fout = 5 - $LV3goed;

$totaalGoed = $LV1goed + $LV2goed + $LV3goed;
$totaalFout = $LV1fout + $LV2fout + $LV3fout;

$goed = false;

if ($totaalGoed > $totaalFout) {
    $goed = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $naam ?></title>
    <link rel="stylesheet" type="text/css" href="css/style2.css"/>
</head>
<body>

<section>
    <a id="terug" href="login.php">Terug</a>

    <h1><?= $naam ?></h1>

    <div>
        <?php if ($goed) { ?>
            <p><?= $naam ?> is goed bezig!</p>
        <?php }else{ ?>
            <p><?= $naam ?> is helaas niet zo goed bezig...</p>
        <?php } ?>
    </div>
    <div id = chart2>
        <img src="https://quickchart.io/chart?c={
  type: 'pie',
  data: {
    datasets: [
      {
        data: [<?= $totaalGoed ?>, <?= $totaalFout ?>],
        backgroundColor: [
          'rgb(54, 162, 235)',
          'rgb(255, 99, 132)',
        ],
        label: 'Dataset 1',
      },
    ],
    labels: ['Totaal goed', 'Totaal fout'],
  },
}
">
    </div>
    <div id = "chart1">
        <img src="https://quickchart.io/chart?c={
          type: 'line',
          data: {
            labels: ['Level 1', 'Level 2', 'Level 3'],
            datasets: [
              {
                label: 'Aantal goed',
                fill: false,
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
                data: [<?= $LV1goed ?>, <?= $LV2goed?>, <?= $LV3goed ?>],
              },
              {
                label: 'Aantal fout',
                fill: false,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?= $LV1fout ?>, <?= $LV2fout?>, <?= $LV3fout ?>],
              },
            ],
          },
        }">
    </div>
    <div>
        <?php if ($goed) { ?>
            <p>U kan er voor kiezen om <?= $naam ?> naar het volgende level te laten gaan. </p>
        <?php }else{ ?>
            <p>U kan er voor kiezen om <?= $naam ?> hetzelfde level te laten spelen of een vorig level opnieuw te doen. </p>
        <?php } ?>
    </div>
</section>

</body>
</html>
