<?php

    include_once '../Connection/connection.php';
    include_once '../AllClasses/Admin.php';


if($_GET['funcao'] == "login"):
  if(!empty($_POST['email']) && !empty($_POST['password'])):
       // dados do login
       $password =trim($_POST['password']);
       $email  = trim($_POST['email']);
   // fim da login
       $conexao =  new  connection();
       $queries = $conexao->getconnection()->prepare("select * from admin where email=:email and password=:password");
       $queries->execute(Array(
            ":email"=>$email ,
            ":password"=>$password
       ));
       if($queries->rowCount() > 0):
              updateLogging($email , $password);
              session_start();
              // pegando o dados do admin
              for(;$linha=$queries->fetch();):
                      $_SESSION['datalogado']= $linha['datalogged'];
                      $_SESSION['name'] = $linha['name'];
                      $_SESSION['logado'] = 1;
              endfor;
              // fim dos dados do admin
              // quando eh logado com sucesso
              header('location:../Pages/admin_sucesso_logado.php');
        else:
               // error no login
              header("location:../index.php?pages=1");
       endif;
          else:
              // error no login
              header("location:../index.php?pages=1");
    endif ;
endif;


function updateLogging($email ,$password){
     $conexao =  new connection();
     $update= $conexao->getconnection()->prepare("update admin set datalogged=:data where email=:email and password=:password");
     $update->execute(Array(
          ":email"=>$email ,
          ":password"=>$password,
          ":data"=>date('y-m-d h-i-s'),
     ));

}


?>
