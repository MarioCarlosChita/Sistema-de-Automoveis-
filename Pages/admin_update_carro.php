<?php
        include_once '../Connection/connection.php';
        include_once '../Controller/Crud.php';

        session_start();
        if($_SESSION['logado']  != 1 &&   $_SESSION['name'] == ""):
              header('location:../index.php');
        endif;
        $id=$_GET['id'];
        $conexao = new connection();
        $crd = new Crud($conexao);
?>


<!DOCTYPE html>
<html lang="pt">
   <head>
         <meta charset="utf-8">
         <title>Sistema de Automoveis</title>
         <link rel="stylesheet" href="../assets/mainstyle.css" type="text/css">
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
                     <li><a  href="admin_sucesso_logado.php" class="activo-menu">Adiocionar Automovel</a></l1>
                     <li><a  href="admin_lista_carro.php">Lista de Automoveis</a></l1>
                     <li><a  href="../Controller/logout.php?funcao=signout">SignOut</a></l1>
                  </ul>
              </div>
       </div>

       <div class ="page-center">
          <div class="card-detail">
             <h1>Nome</h1>
             <br>
             <span>
                  <?php
                     $id=$_GET['id'];
                     echo $crd->getCarro($id)[0]['Nome_Carro'];
                  ?>
              </span>
          </div>

          <div class="card-formulario">
            <?php
                if(isset($_GET['funcao'])):
                  if($_GET['funcao'] == 1):
                    echo "<div class='sucess-file'>";
                       echo  "<p>Atualizado com Sucesso Com Sucesso!</p>";
                   echo "</div>";
                 elseif($_GET['funcao'] ==2):
                  echo "<div class='error'>";
                     echo  "<p>Error este ficheiro não é compactivel com o nosso sistema!</p>";
                  echo "</div>";

                else:
                  echo "<div class='error'>";
                     echo  "<p>Error de cadastramento!</p>";
                  echo "</div>";
               endif;

               endif;
             ?>


                <form action="../Controller/Setting.php?funcao=update&id=<?php echo $id;?>"method="POST"  enctype="multipart/form-data">
               <fieldset>
                <legend>Adicionar Carro</legend>
                <label>Nome </label>
                <input type="text" name="nome" value="<?php  echo $crd->getCarro($id)[0]['Nome_Carro']; ?>">
                <label>Marca</label>
                <input type="text" name="marca" value="<?php  echo $crd->getCarro($id)[0]['Marca_Carro']; ?>">
                <label>Cor</label>
                <select name="cor" value="<?php  echo $crd->getCarro($id)[0]['Cor_Carro']; ?>">
                     <option> nenhum </option>
                     <option> Vermelho </option>
                     <option> Azul </option>
                     <option> Preto</option>
                </select>
                <br>
                <br>
                <label>Descrição</label>
                <input type="text" name="descricao" value="<?php  echo $crd->getCarro($id)[0]['Descricao_Carro']; ?>"></textarea>
                <label>Preco</label>
                <input type="number"name="preco" min="0.00000" step="0.000000" value="<?php  echo $crd->getCarro($id)[0]['Preco_Carro']; ?>"><br><br>
                <label >Quantidade:</label>
                <input type="number" name="quantidade" min="0.00000" step="0.00000" value="<?php  echo $crd->getCarro($id)[0]['Quantidade_Carro']; ?>"><br><br>
                <input type="file" name="file">
                <input type="submit" value="Adicionar">
                </form>
                </fieldset>
          </div>
       </div>

   </body>

</html>
