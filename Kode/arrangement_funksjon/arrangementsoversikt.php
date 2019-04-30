<!DOCTYPE html>
<html>

<head>
  <title>Arrangementsoversikt</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="arrangement_style.css">
</head>

<body>
  <?php
    require("testarrangement.php");
    require("functions.php");

    $sql = "SELECT * FROM Arrangement";
    $resultat = mysqli_query($dbTilkobling, $sql);

    while($row = mysqli_fetch_array($resultat)) {
      echo "<div class='arrangementskort'>
        <img class='oversiktbilde' src=" . $testarrangement[$row['ArrangementsID']]['bilde'] . " alt='illustrasjonsbilde'/>
        <h1>" . $row['Tittel'] . "</h1>
        <p>" . $row['Dato'] . " " . $row['Tid'] . "</p>
        <p>" . $row['Sted'] . "</p>";

        /*$antPaameldte = 0;

        $sqlJoin = "SELECT * FROM Arrangement JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID WHERE Arrangement.ArrangementsID = " . $row['ArrangementsID'] . ";";
        //her oppretter jeg en ny DB-tilkobling
        $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);

        while($row = mysqli_fetch_array($resultatJoin)) {
          $antPaameldte++;
        }

        //må evt koble til den gamle tilkoblingen på nytt for å få ut den siste informasjonen?
        $ledigePlasser = $row['AntPlasser'] - $antPaameldte;*/

        echo "<p>" . $row['AntPlasser'] . " ledige plasser</p>
        <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/paamelding.php?arr=" . $row['ArrangementsID'] . "'>Påmelding</a>
        <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/arrangementsinfo.php?arr=" . $row['ArrangementsID'] . "'>Les mer</a>
      </div>";
    }

    mysqli_close($dbTilkobling);
   ?>
</body>

</html>