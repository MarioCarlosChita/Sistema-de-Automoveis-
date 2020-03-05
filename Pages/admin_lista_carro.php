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

       <div class="lista-items">
             <h1>Lista de Automoveis</h1>
         <div class="top">
             <form action ="admin_lista_carro.php" method="POST">
              <div class="first">
                   <input type="search" name="pesquisa" placeholder="Pesquisa Nome,Marca">
                     <input type="submit"  class="pesquisar">
              </div>
                <div class="second">
                   <p>filtrar Por</p>
                    <input type="number" name="preco" placeholder="Preço" class="number" step="any">
              </div>
           </form>
           <div>

        <div class="resultado">
           <table>
                 <thead>
                    <tr>
                       <td>Imagem</td>
                       <td>Nome</td>
                       <td>Marca</td>
                       <td>Preço</td>
                       <td>Quantidade</td>
                       <td>Cor</td>
                       <td>Data</td>
                       <td>Configurações</td>
                    </tr>
                 <thead>

                   <?php if(empty($_POST['pesquisa'])):?>
                   <tbody>



                       <?php


                                    $conexao =new connection();
                                    $busca = new Crud($conexao);
                                    if($busca->getAll()  == null):
                                          echo '<tr><td></td><td></td><td></td><td></td><td><p style="text-align:center;font-size:23px;"> Lista Vazia!</p><td></tr>';
                                    else:
                                         for($i = 0 ;$i<sizeof($busca->getAll()); ++$i):
                                            echo "<tr>";
                                            $id=$busca->getAll()[$i]['Id_Carro'];

                                            echo '<td><a href="admin_visualiza_photo.php?id='.$id.'"><img src="../upload-files/'.$busca->getAll()[$i]['Image_Carro'].'" width=50px; height=50px/></a></td>';
                                            echo '<td>'.$busca->getAll()[$i]['Nome_Carro'].'</td>';
                                            echo '<td>'.$busca->getAll()[$i]['Marca_Carro'].'</td>';
                                            echo '<td>'.$busca->getAll()[$i]['Preco_Carro'].'</td>';
                                            echo '<td>'.$busca->getAll()[$i]['Quantidade_Carro'].'</td>';
                                            echo '<td>'.$busca->getAll()[$i]['Cor_Carro'].'</td>';
                                            echo '<td>'.$busca->getAll()[$i]['Data_Carro'].'</td>';
                                            echo '<td><a href="../Pages/Comfirmar_deletar.php?funcao=deletar&id='.$busca->getAll()[$i]['Id_Carro'].'">Deletar</a>
                                             ///<a href="admin_update_carro.php?id='.$busca->getAll()[$i]['Id_Carro'].'">Alterar</a>
                                            </td>';
                                            echo  "</tr>";
                                        endfor;
                                    endif;
                            ?>

                   </tbody>

                 <?php

                   else :
                     echo "<tbody>";
                     echo "<tr>";
                     $pesquisa ='%'.trim($_POST['pesquisa']).'%';
                     $preco = trim($_POST['preco']);
                     $conexao =  new connection();
                     if(!empty($preco) ){
                       // quando o campo preco nao esta vazio
                       $query = $conexao->getconnection()->prepare('SELECT * FROM carro WHERE Nome_Carro LIKE :pesquisa or Marca_Carro LIKE :pesquisa and Preco_Carro=:preco');
                       $query->execute(
                         array(
                         ":pesquisa"=>$pesquisa,
                         ":preco"=>$preco
                        )
                     );
                     }else{
                       $query = $conexao->getconnection()->prepare('SELECT * FROM carro WHERE Nome_Carro LIKE :pesquisa or Marca_Carro LIKE :pesquisa');
                       $query->execute(
                         array(
                         ":pesquisa"=>$pesquisa
                       ));
                     }
                      if($query->rowCount() != 0):
                         while($linha =$query->fetch()):
                           echo "<tr>";
                           echo '<td><a href="admin_visualiza_photo.php?id='.$linha['Id_Carro'].'"><img src="../upload-files/'.$linha['Image_Carro'].'" width=50px; height=50px/></a></td>';
                           echo '<td>'.$linha['Nome_Carro'].'</td>';
                           echo '<td>'.$linha['Marca_Carro'].'</td>';
                           echo '<td>'.$linha['Preco_Carro'].'</td>';
                           echo '<td>'.$linha['Quantidade_Carro'].'</td>';
                           echo '<td>'.$linha['Cor_Carro'].'</td>';
                           echo '<td>'.$linha['Data_Carro'].'</td>';
                           echo '<td><a href="../Pages/Comfirmar_deletar.php?funcao=deletar&id='.$linha['Id_Carro'].'">Deletar</a>
                            ///<a href="../Controller/Setting.php?funcao=deletar&id='.$linha['Id_Carro'].'">Alterar</a>
                           </td>';
                           echo  "</tr>";
                         endwhile;
                      else:
                            echo '<tr><td></td><td></td><td></td><td></td><td><p style="text-align:center;font-size:23px;"> Nenhum Carro Encontrado!</p><td></tr>';
                      endif;
                   ?>
                 <?php
                        echo "</tr>";
                        echo "</tbody>";
                        endif;
                  ?>

          </table>
           </div>
       </div>

   </body>

</html>
