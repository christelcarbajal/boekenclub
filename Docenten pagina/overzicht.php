<?php

session_start();

$email = $_SESSION['login'];

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/** @var $db */
require_once "DB.php";

if ($_GET['id']){
    $id = $_GET['id'];

    $query = "SELECT * FROM kinderen WHERE id = '$id'";
    $result = mysqli_query($db, $query);

    if ($result){
        $kind = mysqli_fetch_assoc($result);

        $name = $kind['name'];

        $LV1goed = $kind['LV1 goed'];
        $LV1fout = 5 - $LV1goed;

        $LV2goed = $kind['LV2 goed'];
        $LV2fout = 5 - $LV2goed;

        $LV3goed = $kind['LV3 goed'];
        $LV3fout = 5 - $LV3goed;

        $totaalGoed = $LV1goed + $LV2goed + $LV3goed;
        $totaalFout = $LV1fout + $LV2fout + $LV3fout;

        if ($totaalGoed > $totaalFout) {
            $goed = true;
        }else{
            $goed = false;
        }
    }
}else{
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $name ?></title>
    <link rel="stylesheet" type="text/css" href="css/style2.css"/>
</head>
<body>

<section>
    <a id="terug" href="login.php">Terug</a>

    <h1><?= $name ?></h1>

    <div>
        <?php if ($goed) { ?>
            <p><?= $name ?> is goed bezig!</p>
        <?php }else{ ?>
            <p><?= $name ?> is helaas niet zo goed bezig...</p>
        <?php } ?>
    </div>
    <div id = chart2> <!-- API is used for showing chart -->
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
    <div id = "chart1"> <!-- API is used for showing chart -->
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
        <?php if ($goed) { // gives advise to teacher ?>
            <p>U kan er voor kiezen om <?= $name ?> naar het volgende level te laten gaan. </p>
        <?php }else{ ?>
            <p>U kan er voor kiezen om <?= $name ?> hetzelfde level te laten spelen of een vorig level opnieuw te doen. </p>
        <?php } ?>
    </div>
    <div>
        <a id = "terug" href = delete.php?id=<?= $id ?>>Verwijder <?= $name ?></a>
        <a id = "terug" href = edit.php?id=<?= $id ?>>Verander naam</a>
    </div>
</section>

</body>
</html>
