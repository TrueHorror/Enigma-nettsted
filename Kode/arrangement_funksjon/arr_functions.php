<?php
    //functions.php
    $dbTilkobling = mysqli_connect('itstud.hiof.no', 'uinv19gr5', 'NQh_L2c8d%vaNn@D', 'uinv19gr5');

    //Print error message if no connection
    if($dbTilkobling->connect_error) {
        die($dbTilkobling->connect_errno. ": ".$dbTilkobling->connect_error);
    }

    function booleanTilString($boolean) {
      if ($boolean == "1") {
        return "Ja";
      }
      else {
        return "Nei";
      }
    }

    function konverterDato($dato) {
      $dato = str_replace('.', '-', $dato);
      return date('Y-m-d', strtotime($dato));
    }

    function arrfarge($arrType) {
     if ($arrType == "BedPres") {
        return "bedpres";
      }
      else if ($arrType == "For") {
        return "for";
      }
      else if ($arrType == "LAN") {
        return "lan";
      }
      else if ($arrType == "Sos") {
        return "sos";
      }
      else {
        return "andre";
      }
    }

?>