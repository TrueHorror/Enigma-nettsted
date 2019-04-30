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
  require("functions.php");

  if (ISSET($_GET['arr'])) {
    $antPaameldte = 0;

    $sqlJoin = "SELECT * FROM Arrangement JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID WHERE Arrangement.ArrangementsID = " . $_GET['arr'] . ";";
    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);

    while($row = mysqli_fetch_array($resultatJoin)) {
      $antPaameldte++;
    }

    $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
    $resultat = mysqli_query($dbTilkobling, $sql);

    while($row = mysqli_fetch_array($resultat)) {

      $arrId = $testarrangement[$_GET['arr']];
      $ledigePlasser = $row['AntPlasser'] - $antPaameldte;

      echo "<img src='" . $arrId['bilde'] . " ' width=400 alt'illustrasjonsbilde'/>
      <h1>" . $row['Tittel'] . "</h1>
      <p>" . $row['Dato'] . " " . $row['Tid'] . "</p>
      <p>" . $ledigePlasser . " ledige plasser</p>
      <p>" . $row['Beskrivelse'] . "</p>
      <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/paamelding.php?arr=" . $_GET['arr'] . "'>Påmelding</a>";
    }
  }
  mysqli_close($dbTilkobling);
  ?>

</body>

</html>