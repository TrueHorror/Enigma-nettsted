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

    if (ISSET($_GET['arr'])) {

      $sql = "SELECT * FROM Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";
      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {

        //$arrId = $testarrangement[$_GET['arr']];

        echo "<h1>Påmelding: " . $row['Tittel'] . "</h1>
        <strong><p>" . $row['Dato'] . " " . $row['Tid'] . "</p></strong>";
      }
    }
    mysqli_close($dbTilkobling);
  ?>

  <form action='bekreft.php' method='post'>
    <input type='hidden' name='arrId' value='<?php echo $_GET['arr']; ?>'>
    <p>
      <label for='navn'>Navn</label>
      <input type='text' name='navn' id='navn'/>
    </p>
    <p>
      <label for='epost'>E-post</label>
      <input type='email' name='epost' id='epost'/>
    </p>
    <p>
      <label for='erMedlem'>Er du medlem av Enigma?</label><br>
      <input type='radio' name='erMedlem' id='erMedlem' value='1'> Ja
      <input type='radio' name='erMedlem' id='erMedlem' value='0'> Nei
    </p>
    <p>
      <label for='kommentar'>Har du noen spørsmål eller kommentarer?</label><br>
      <textarea name='kommentar' cols='40' rows='5' id='kommentar'></textarea>
    </p>
    <input type='submit' name='submit' value='Neste'/>
  </form>
  <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/arrangementsoversikt.php'>Avbryt</a>
</body>

</html>