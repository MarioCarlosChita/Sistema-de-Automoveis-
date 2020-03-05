<?php

  include_once '../AllClasses/Carro.php';
  include_once '../Connection/connection.php';
  include_once '../Controller/Crud.php';


  if($_GET['funcao'] == "add"):

        // campos para o cadastros dos dados
        $conexao = new connection();
        $crd =  new Crud($conexao);

        $nome = $_POST['nome'];
        $marca =$_POST['marca'];
        $preco  =$_POST['preco'];
        $cor   = $_POST['cor'];
        $descricao = $_POST['descricao'];
        $quantidade =$_POST['quantidade'];
       // fim dos campos de cadastros

       // upload da image
     $filename =$_FILES['file']['name'];
     $fileTmpNama =$_FILES['file']['tmp_name'];
     $filesize =  $_FILES['file']['size'];
     $fileerror = $_FILES['file']['error'];
     $filetype =$_FILES['file']['type'];

     $fileExt = explode('.' ,$filename);
     $fileActualExt =  strtolower(end($fileExt));
     $allowed = array('jpg', 'gif','png','jpeg');

     if(in_array($fileActualExt , $allowed)):
          if($fileerror == 0 ):
                   // movendo o ficheiro
                   $fileNewName = uniqid('' , true).".".$fileActualExt;
                   $fileDestination = "../upload-files/".$fileNewName;
                   move_uploaded_file($fileTmpNama ,$fileDestination);
                  //fim do ficheiro
                  // cadastrado os dados
                  $carro =  new carro($nome,$fileNewName,$marca ,$descricao,$preco ,$quantidade, date('y-m-d h-i-s'),$cor);
                  $crd->add($carro);
                  header('location:../Pages/admin_sucesso_logado.php?funcao=1');

                  // fim do cadastro
                else:
               header('location:../Pages/admin_sucesso_logado.php?funcao=2');
        endif;

                else:
               header('location:../Pages/admin_sucesso_logado.php?funcao=3');
      endif;

  endif;

  if($_GET['funcao']  == "deletar"):
        $conexao  = new connection();
        $crd =  new Crud($conexao);
        $id_carro = $_GET['id'];
        $crd->deletar($id_carro);
        header('location:../Pages/admin_lista_carro.php');
  endif;


if($_GET['funcao'] == "update"):
  $conexao  = new connection();
  $crd =  new Crud($conexao);
  $id_carro = $_GET['id'];
  $nome = $_POST['nome'];
  $marca =$_POST['marca'];
  $preco  =$_POST['preco'];
  $cor   = $_POST['cor'];
  $descricao = $_POST['descricao'];
  $quantidade =$_POST['quantidade'];
 // fim dos campos de cadastros

 // upload da image
$filename =$_FILES['file']['name'];
$fileTmpNama =$_FILES['file']['tmp_name'];
$filesize =  $_FILES['file']['size'];
$fileerror = $_FILES['file']['error'];
$filetype =$_FILES['file']['type'];

$fileExt = explode('.' ,$filename);
$fileActualExt =  strtolower(end($fileExt));
$allowed = array('jpg', 'gif','png','jpeg');

if(in_array($fileActualExt , $allowed)):
    if($fileerror == 0 ):
             // movendo o ficheiro
             $fileNewName = uniqid('' , true).".".$fileActualExt;
             $fileDestination = "../upload-files/".$fileNewName;
             move_uploaded_file($fileTmpNama ,$fileDestination);
            //fim do ficheiro
            // cadastrado os dados
            $carro =  new carro($nome,$fileNewName,$marca ,$descricao,$preco ,$quantidade, date('y-m-d h-i-s'),$cor);
            $crd->update($carro ,$id_carro);
             header('location:../Pages/admin_update_carro.php?funcao=1&id='.$id_carro);
            // fim do cadastro
          else:
         header('location:../Pages/admin_update_carro.php?funcao=2&id='.$id);
  endif;
          else:
         header('location:../Pages/admin_update_carro.php?funcao=3&id='.$id);
endif;


endif;


 ?>
