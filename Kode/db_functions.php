<!DOCTYPE html>
<html>
  <head>
    <title>Page Title</title>
  </head>
  <body>
    <?php
      $database = new mysqli('itstud.hiof.no', 'fredrivo', 'fredrivo_uin_v19', 'fredrivo_uin_v19');

      //Feilmelding ved connection error
      if ($database->connect_error) {
        die($database->connect_errno. ": ".$database->connect_error);
      }

      
    ?>
  </body>
</html>
