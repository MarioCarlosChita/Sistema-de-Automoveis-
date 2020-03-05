<?php
  session_start();
  if($_GET['funcao']  == "signout"):
          $_SESSION['name']  = "";
          $_SESSION['logado'] =  0 ;
          session_destroy();
          header('location:../index.php');
  endif;





?>
