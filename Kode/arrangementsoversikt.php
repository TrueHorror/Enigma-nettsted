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

    foreach ($testarrangement as $key => $value) {
      echo "<div class='arrangementskort'>
        <img class='oversiktbilde' src=" . $value['bilde'] . " alt='illustrasjonsbilde'/>
        <h1>" . $value['tittel'] . "</h1>
        <p>" . $value['dato'] . " " . $value['tid'] . "</p>
        <p>" . $value['sted'] . "</p>
        <p>" . $value['antPlasser'] . " ledige plasser</p>
        <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/paamelding.php?arr=" . $key . "'>Påmelding</a>
        <a href='https://itstud.hiof.no/~iedahl/uin2019/arrangement_funksjon/arrangementsinfo.php?arr=" . $key . "'>Les mer</a>
      </div>";
    }
   ?>
</body>

</html>