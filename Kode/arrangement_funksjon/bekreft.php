<!DOCTYPE html>
<html>

<head>
  <title>Min side</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="arrangement_style.css">

</head>

<body>


  <?php
    require("testarrangement.php");
    require("functions.php");

    if(ISSET($_POST['submit'])) {

      $arrId = $_POST['arrId'];
      $navn = $_POST['navn'];
      $epost = $_POST['epost'];
      $erMedlem = $_POST['erMedlem'];
      $kommentar = $_POST['kommentar'];

      $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $arrId . ";";
      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        echo "<h1>Bekreft påmelding</h1>
          <form method='post' action='bekreft.php'>
          <input type='hidden' name='arrId' value='" . $arrId . "'>
          <input type='hidden' name='tittel' value='" . $row['Tittel'] . "'>
          <input type='hidden' name='navn' value='" . $navn . "'>
          <input type='hidden' name='epost' value='" . $epost . "'>
          <input type='hidden' name='erMedlem' value='" . $erMedlem . "'>
          <input type='hidden' name='kommentar' value='" . $kommentar . "'>

          <p><strong>Arrangement: </strong>" . $row['Tittel'] . "</p>
          <p><strong>Tid og dato: </strong>" . $row['Dato'] . " " . $row['Tid'] . "</p>
          <p><strong>Navn: </strong>" . $navn . "</p>
          <p><strong>E-post: </strong>" . $epost . "</p>
          <p><strong>Medlem: </strong>" . booleanTilString($erMedlem) . "</p>
          <p><strong>Kommentar: </strong>" . $kommentar . "</p>

          <input type='submit' name='bekreft' value='Bekreft'/>
        </form>";
      }
    }

    if(ISSET($_POST['bekreft'])) {

      $arrId = $_POST['arrId'];
      $tittel = $_POST['tittel'];
      $navn = $_POST['navn'];
      $epost = $_POST['epost'];
      $erMedlem = $_POST['erMedlem'];
      $kommentar = $_POST['kommentar'];

      $sql = "INSERT INTO Paameldte(ArrangementsID, Epost, Navn, ErMedlem, Kommentar) VALUES (" . $arrId . ",'" . $epost . "','" . $navn . "', " . $erMedlem . ",'" . $kommentar . "');";

      if(mysqli_query($dbTilkobling, $sql)) {
        echo "<h2>Du er påmeldt " . $tittel . "</h2>
        <p>En bekreftelse har blitt sendt til din e-post: " . $epost . ".</p>
        <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/arrangementsoversikt.php'>Til forsiden</a>";
      }
      else {
        echo "<p>Det oppsto en feil, vennligst prøv igjen.</p>";
      }
    }
    mysqli_close($dbTilkobling);
  ?>

</body>

</html>