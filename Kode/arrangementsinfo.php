<!DOCTYPE html>
<html>

<head>
  <title>Arrangementsinfo</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="arrangement_style.css">
</head>

<body>

  <?php
  require("testarrangement.php");

  if (ISSET($_GET['arr'])) {

    $arrId = $testarrangement[$_GET['arr']];

    echo "<img src='" . $arrId['bilde'] . " ' width=400 alt'illustrasjonsbilde'/>
    <h1>" . $arrId['tittel'] . "</h1>
    <p>" . $arrId['dato'] . " " . $arrId['tid'] . "</p>
    <p>" . $arrId['antPlasser'] . " ledige plasser</p>
    <p>" . $arrId['beskrivelse'] . "</p>
    <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/paamelding.php?arr=" . $_GET['arr'] . "'>Påmelding</a>";
  }

  ?>

</body>

</html>