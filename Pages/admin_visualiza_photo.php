<?php
        include_once '../Connection/connection.php';
        include_once '../Controller/Crud.php';
        session_start();

        if($_SESSION['logado']  != 1 &&   $_SESSION['name'] == ""):
              header('location:../index.php');
        endif;
        $conexao = new connection();

?>
<!DOCTYPE html>
<html lang="pt">
   <head>
         <meta charset="utf-8">
         <title>Sistema de Automoveis</title>
         <link rel="stylesheet" href="../assets/view.css" type="text/css">
   </head>
   <body>
        <div class="view">

            <div class="page">
              <h4><a href="admin_lista_carro.php">Retroceder</a></h4>
            </div>
            <div class="image">
               <?php
                   $conexao = new connection();
                   $crd = new Crud($conexao);
                   $id_carro =$_GET['id'];

                   for($i = 0; $i<sizeof($crd->getCarro($id_carro)) ; ++$i):
                      echo '<img src="../upload-files/'.$crd->getCarro($id_carro)[$i]['Image_Carro'].'" width=800px; height=300px;/>';
                  endfor;
                 ?>

            </div>


            <div class="descricao">
              <?php
              $conexao = new connection();
              $crd = new Crud($conexao);
              $id_carro =$_GET['id'];

              for($i = 0; $i<sizeof($crd->getCarro($id_carro)) ; ++$i):
                 echo '<p>'.$crd->getCarro($id_carro)[$i]['Descricao_Carro'].'</p>';
             endfor;

              ?>
            </div>

        </div>



   </body>

</html>
