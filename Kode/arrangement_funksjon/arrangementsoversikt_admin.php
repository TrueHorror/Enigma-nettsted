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
       header("Location: admin_login.php");

    }
    require("testarrangement.php");
    require("functions.php");

    if (ISSET($_GET['arr'])) {
      $sqlPaameldteDelete = "DELETE from Paameldte WHERE ArrangementsID = " . $_GET['arr'] . ";";
      $sqlDelete = "DELETE from Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";

      mysqli_query($dbTilkobling, $sqlPaameldteDelete);

      

              if(mysqli_query($dbTilkobling, $sqlDelete)) {
                echo "<h2>Arrangementet er slettet</h2>";
              }
              else {
                echo mysqli_error($dbTilkobling);
                echo "<p>Det oppsto en feil, vennligst prøv igjen. " . mysqli_error($dbTilkobling) . "</p>";
              }
            
    }

    echo "<table>
      <tr>
        <th>Tittel</th>
        <th>Plasser igjen</th>
        <th>Tid</th>
        <th>Sted</th>
        <th>Opprettet</th>
        <th>Handlinger</th>
      </tr>";

      $sql = "SELECT * FROM Arrangement";
      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        echo "<tr>
          <td><a href='arrangementsinfo_admin.php?arr=" . $row['ArrangementsID'] . "'>" . $row['Tittel'] . "</a></td>
          <td>" . $row['AntPlasser'] . "</td>
          <td>" . $row['Dato'] . " " . $row['Tid'] . "</td>
          <td>" . $row['Sted'] . "</td>
          <td>" . $row['Opprettet'] . "</td>
          <td><a onClick=\"return confirm('Vill du virkelig slette arrangementet?')\" id='slett' href='arrangementsoversikt_admin.php?arr=" . $row['ArrangementsID'] . "'>Slett</a> 
              <a  href='nyttarrangement.php?arr=" . $row['ArrangementsID'] . "'>Rediger</a></td>
        </tr>";
      }

    echo "</table>";

    mysqli_close($dbTilkobling);
   ?>
   <br>
   <a href="nyttarrangement.php">Opprett nytt arrangement</a>

</body>

</html>