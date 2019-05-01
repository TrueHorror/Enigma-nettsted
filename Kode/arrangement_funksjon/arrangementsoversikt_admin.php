<!DOCTYPE html>
<html>

<head>
  <title>Min side</title>
  <meta charset="UTF-8"/>
  <link rel="stylesheet" type="text/css" href="arrangement_style.css">

  <!-- <script>

    function delete(){

      var del=confirm("Are you sure you want to delete this record?");
      if (del==true){
         alert ("record deleted")
      }
      return del;

    }
   
  </script> -->

</head>

<body>
  <?php
    require("testarrangement.php");
    require("functions.php");

    //må få til en bekreftelse før man sletter et arrangement
    if (ISSET($_GET['arr'])) {
      $sqlPaameldteDelete = "DELETE from Paameldte WHERE ArrangementsID = " . $_GET['arr'] . ";";
      $sqlDelete = "DELETE from Arrangement WHERE ArrangementsID = " . $_GET['arr'] . ";";

      mysqli_query($dbTilkobling, $sqlPaameldteDelete);

      /*echo "<script type='text/javascript'>function slett() {
            if (confirm('Vil du virkelig slette arrangementet?')) {";*/

              if(mysqli_query($dbTilkobling, $sqlDelete)) {
                echo "<h2>Arrangementet er slettet</h2>";
              }
              else {
                echo mysqli_error($dbTilkobling);
                echo "<p>Det oppsto en feil, vennligst prøv igjen. " . mysqli_error($dbTilkobling) . "</p>";
              }
            //echo "} </script>";
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

      $sql = "SELECT * FROM Arrangement ORDER BY Opprettet DESC";
      $resultat = mysqli_query($dbTilkobling, $sql);

      while($row = mysqli_fetch_array($resultat)) {
        $dato = date('j/n/Y', strtotime($row['Dato']));
        $opprettet = date('j/n/Y H:i', strtotime($row['Opprettet']));

        echo "<tr>
          <td><a href='arrangementsinfo_admin.php?arr=" . $row['ArrangementsID'] . "'>" . $row['Tittel'] . "</a></td>
          <td>" . $row['AntPlasser'] . "</td>
          <td>" . $dato . " " . $row['Tid'] . "</td>
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