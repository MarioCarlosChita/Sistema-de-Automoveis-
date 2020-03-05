<?php
        include_once '../Connection/connection.php';
        include_once '../Controller/Crud.php';
        session_start();
        if($_SESSION['logado']  != 1 &&   $_SESSION['name'] == ""):
              header('location:../index.php');
        endif;
?>

<!DOCTYPE html>
<html lang="pt">
   <head>
         <meta charset="utf-8">
         <title>Sistema de Automoveis</title>
         <link rel="stylesheet" href="../assets/mainstyle.css" type="text/css">
          <link rel="stylesheet" href="../assets/StyleLista.css" type="text/css">
   </head>
   <body>

        <div class="container">

              <div class="container-logo">
                  <div>
                      <h3>Admin =><span><?php echo $_SESSION['name']?></span></h3>
                  </div>

                  <div>
                      <span>Login Date:<?php echo $_SESSION['datalogado'];?></span>
                  </div>
              </div>

              <div class="container-menu">
                  <ul>
                     <li><a  href="admin_sucesso_logado.php" >Adiocionar Automovel</a></l1>
                     <li><a  href="admin_lista_carro.php" class="activo-menu">Lista de Automoveis</a></l1>
                     <li><a  href="../Controller/logout.php?funcao=signout">SignOut</a></l1>
                  </ul>
              </div>
       </div>

        <div class="info">
         <h1>
             Deseja realmente deletar?
         </h1>
        </div>

        <div class="box-buttoes">

              <a href="../Controller/Setting.php?funcao=deletar&id=<?php echo $_GET['id']?>">
                      <div>
                          <p>Yes</p>
                      </div>
              </a>
              <a href="admin_lista_carro.php">
                      <div>
                          <p>NO</p>
                      </div>
              </a>
        </div>


   </body>

</html>
