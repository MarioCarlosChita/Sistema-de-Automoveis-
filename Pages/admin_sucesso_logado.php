<?php
        include_once '../Connection/connection.php';
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
             <h1>Quantidade Total</h1>
             <br>
             <span>
                  <?php
                    $queries = $conexao->getconnection()->prepare('select * from carro');
                    $queries->execute();
                    echo $queries->rowCount();
                  ?>
              </span>
          </div>

          <div class="card-formulario">
            <?php
                if(isset($_GET['funcao'])):
                  if($_GET['funcao'] == 1):
                    echo "<div class='sucess-file'>";
                       echo  "<p>Cadastrado Com Sucesso!</p>";
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


                <form action="../Controller/Setting.php?funcao=add "method="POST"  enctype="multipart/form-data">
               <fieldset>
                <legend>Adicionar Carro</legend>
                <label>Nome </label>
                <input type="text" name="nome">
                <label>Marca</label>
                <input type="text" name="marca">
                <label>Cor</label>
                <select name="cor">
                     <option> nenhum </option>
                     <option> Vermelho </option>
                     <option> Azul </option>
                     <option> Preto</option>
                </select>
                <br>
                <br>
                <label>Descrição</label>
                <textarea type="text" name="descricao"></textarea>
                <label>Preco</label>
                <input type="number"name="preco" min="0.001" step="0.001"><br><br>
                <label >Quantidade:</label>
                <input type="number" name="quantidade" min="0.001" step="0.001"><br><br>
                <input type="file" name="file">
                <input type="submit" value="Adicionar">
                </form>
                </fieldset>
          </div>
       </div>

   </body>

</html>
