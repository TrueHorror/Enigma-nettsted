<!DOCTYPE html>
<html>

<head>
  <title>Min side</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="arrangement_style.css">
</head>

<body>

  <?php
  session_start();
    if(!isset($_SESSION['user'])){
       header("Location: ../login_funksjon/admin_login.php");

    }
  require("testarrangement.php");
  require("testpaameldte.php");
  require("functions.php");

  if (ISSET($_GET['arr'])) {
    $antPaameldte = 0;

    $sqlJoin = "SELECT * FROM Arrangement JOIN Paameldte ON Arrangement.ArrangementsID = Paameldte.ArrangementsID WHERE Arrangement.ArrangementsID = " . $_GET['arr'] . ";";
    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);

    while($row = mysqli_fetch_array($resultatJoin)) {
      $antPaameldte++;
    }

    $sqlArr = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
    $resultatArr = mysqli_query($dbTilkobling, $sqlArr);

    while($row = mysqli_fetch_array($resultatArr)) {

      $arrId = $testarrangement[$_GET['arr']];

      $ledigePlasser = $row['AntPlasser'] - $antPaameldte;

      $dato = date('j/n/Y', strtotime($row['Dato']));
      $opprettet = date('j/n/Y H:i', strtotime($row['Opprettet']));

      echo "<img src='" . $arrId['bilde'] . " ' width=400 alt'illustrasjonsbilde'/>
      <h1>" . $row['Tittel'] . "</h1>
      <p>Opprettet: " . $opprettet . "</p>
      <p>Dato: " . $dato . " " . $row['Tid'] . "</p>
      <p>" . $ledigePlasser . " ledige plasser</p>
      <p>" . $row['Beskrivelse'] . "</p><br>
      <p><strong>Antall påmeldte: " . $antPaameldte . " totalt</strong></p>
      <table>
        <tr>
          <th>Navn</th>
          <th>E-post</th>
          <th>Medlem</th>
          <th>Kommentar</th>
        </tr>";
    }

    $resultatJoin = mysqli_query($dbTilkobling, $sqlJoin);
    while($row = mysqli_fetch_array($resultatJoin)) {
      echo "<tr>
          <td>" . $row['Navn'] . "</td>
          <td>" . $row['Epost'] . "</td>
          <td>" . booleanTilString($row['ErMedlem']) . "</td>
          <td>" . $row['Kommentar'] . "</td>
        </tr>";
    }
  }
  mysqli_close($dbTilkobling);
  ?>
  </table>

  <br>
  <a href='arrangementsoversikt_admin.php'>Tilbake</a>

</body>

</html>