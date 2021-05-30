<?php

$kind = "John koos";

$LV1goed = 2;
$LV1fout = 3;

$LV2goed = 4;
$LV2fout = 1;

$LV3goed = 5;
$LV3fout = 0;

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
    <title><?= $kind ?></title>
    <link rel="stylesheet" type="text/css" href="style2.css"/>
</head>
<body>

<section>
    <a id="terug" href="login.php">Terug</a>

    <h1><?= $kind ?></h1>

    <div>
        <?php if ($goed) { ?>
            <p><?= $kind ?> is goed bezig!</p>
        <?php }else{ ?>
            <p><?= $kind ?> is helaas niet zo goed bezig...</p>
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
            <p>U kan er voor kiezen om <?= $kind ?> naar het volgende level te laten gaan. </p>
        <?php }else{ ?>
            <p>U kan er voor kiezen om <?= $kind ?> hetzelfde level te laten spelen of een vorig level opnieuw te doen. </p>
        <?php } ?>
    </div>
</section>

</body>
</html>
