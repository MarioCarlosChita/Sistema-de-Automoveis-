<?php
    // apis cabelhaco
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
  // fim da apis
    include_once '../Connection/connection.php';
    include_once '../Controller/Crud.php';
    include_once '../AllClasses/Carro.php';

 // pegando todos os dados na banco de dados
    if($_GET['funcao'] == "lista"):
     $conexao = new connection();
     http_response_code(200);
     $crd = new Crud($conexao);
     echo json_encode($crd->getAll());
    endif;
  // fim do codigo

   if($_GET['funcao'] == 'deletar'):
     $conexao = new connection();
     http_response_code(200);
     $id=$_GET['id'];
     $crd = new Crud($conexao);
     $crd->deletar($id);
   endif;


   if($_GET['funcao']  == "add"):
     $nome = $_GET['nome'];
     $marca =$_GET['marca'];
     $preco  = $_GET['preco'];
     $cor   = $_GET['cor'];
     $descricao = "teste de Apis";
     $quantidade =$_GET['quantidade'];
     $conexao = new connection();
     $crd =  new Crud($conexao);
     $carro =  new carro($nome,'teste.jpeg',$marca ,$descricao,$preco ,$quantidade, date('y-m-d h-i-s'),$cor);
     $crd->add($carro);
     http_response_code(200);
   endif;


   if($_GET['funcao']  == "update"):
     $id =$_GET['id'];
     $nome = $_GET['nome'];
     $marca =$_GET['marca'];
     $preco  = $_GET['preco'];
     $cor   =$_GET['cor'];
     $descricao = "teste de Apis";
     $quantidade =$_GET['quantidade'];
     $conexao = new connection();
     $crd =  new Crud($conexao);
     $carro =  new carro($nome,'teste.jpeg',$marca ,$descricao,$preco ,$quantidade, date('y-m-d h-i-s'),$cor);
     $crd->update($carro , $id);
     http_response_code(200);
   endif;



?>
