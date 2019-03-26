<?php

session_start();

//Database tilkobling
$database = new mysqli('itstud.hiof.no', 'fredrivo', 'fredrivo_uin_v19', 'fredrivo_uin_v19');

$errors = array();

  // call these variables with the global keyword to make them available in function
  global $db, $errors, $username, $email;


function display_error() {
  global $errors;

  if (count($errors) > 0){
    echo '<div class="error">';
      foreach ($errors as $error){
        echo $error .'<br>';
      }
    echo '</div>';
  }
}

if (isset($_POST['login_btn'])) {
  login();
}

function login(){
  $username = e($_POST['username']);
  $password = e($_POST['password']);

  if (empty($username)) {
    array_push($errors, "Brukernavn er ikke fylt i.");
  }
  if (empty($password)) {
    array_push($errors, "Passord er ikke fylt i.");
  }

  if (count($errors) == 0) {
    $password = md5($password);

    $query = "SELECT * FROM admin_cred WHERE melk='$username' AND potetgull='$password' LIMIT 1";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $logged_in_user = mysqli_fetch_assoc($results);

        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";

        header('location: admin_panel.php');

    }else {

      array_push($errors, "Feil Brukernavn/Passord kombinasjon.");
 
    }
  }


}


?>
 
