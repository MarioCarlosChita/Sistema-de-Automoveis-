<!DOCTYPE html>
<html lang="pt">
   <head>
         <meta charset="utf-8">
         <title>Sistema de Automoveis</title>
         <link rel="stylesheet" href="assets/style.css" type="text/css">
   </head>
   <body>
        <div class="container">
           <div class="container-tituto">
              <h3>SignIn</h3>
              <span>Sistema de Gestão de Automoveis</span>
             <?php
                 if(isset($_GET['pages'])):
                    if($_GET['pages'] == 1 ):
                    echo "<div class='error'>";
                    echo  "<p>Palavra passe incorrecta,porfavor tenta novamente!</p>";
                    echo "</div>";
                  endif;
                endif;
             ?>
           </div>
           <div class ="container-formulario">
              <form action="Controller/Login.php?funcao=login" method="POST">
                     <label>Email</label>
                      <input type="email" name="email" placeholder="Email" required="">
                      <label>Password</label>
                      <input type="password" name="password" placeholder="Password" required="">
                      <input type="submit" value="Entrar" class="submit-butao">
              </form>
           </div>
        </div>

   </body>

</html>
