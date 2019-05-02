<?php

if (isset($_POST['login_btn'])) {
  require('db-connection.php');
  S
  $username = $_POST['brukernavn'];
  $password = $_POST['passord'];

  if (empty($username) || empty($password) ) {
    header("Location: " . site_url() . "../page-admin-login.php?error=emptyfields");
    exit();
  }
  else {
    //melk = brukernavn og potetgull = passord
    $sql = "SELECT * FROM admin_cred WHERE melk=?;";
    $statement = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
      header("Location: page-admin-login.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($statement, "s", $username);
      mysqli_stmt_execute($statement);
      $result = mysqli_stmt_get_result($statement);

      if ($row = mysqli_fetch_assoc($result)) {
        $pwCheck = password_verify($password, $row['potetgull']);
        
        if ($pwCheck == false) {
          header("Location: page-admin-login.php?error=wrongpassword");
          exit();

        }
          else if ($pwCheck == true) {
            session_start();
            $_SESSION['user'] = $row['melk'];



            header("Location: page-admin-panel.php");
            exit();

          }
        
        else {
          header("Location: page-admin-login.php?error=wrongpassword");
          exit();
        }



      }
      else {
        header("Location: page-admin-login.php?error=nouser");
        exit();

      }

    }
  }
}
?>
 
