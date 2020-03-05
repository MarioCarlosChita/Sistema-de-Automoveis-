<?php

Class Crud{

  private $conexao;
  public function __construct($con){
        $this->conexao = $con;
  }
  // adicionando um carro no sistema
  public function add($carro){
        $adicionar = $this->conexao->getconnection()->prepare('Insert into
        carro(Nome_Carro,Image_Carro,Marca_Carro,Preco_Carro,Descricao_Carro ,Quantidade_Carro ,Data_Carro,Cor_Carro)
        values(:nome,:image,:marca,:preco,:descricao,:quantidade,:data,:cor)');
        $adicionar->execute(Array(
          ":nome"=>$carro->getNome() ,
          ":image"=>$carro->getImage(),
          ":marca"=>$carro->getMarca(),
          ":preco"=>$carro->getPreco(),
          ":descricao"=>$carro->getDescricao(),
          ":quantidade"=>$carro->getQuantidade(),
          ":data"=>$carro->getData() ,
          ":cor"=>$carro->getCor()
        ));
    }
 // fim do add

  // deletando o carro
  public  function deletar($id){
      $deletar = $this->conexao->getconnection()->prepare("delete from Carro where Id_Carro=:id");
      $deletar->execute(Array(
        ":id"=>$id
      ));
  }
 // fim do  deletar

// update Carro
public function update($carro , $id){
    $update = $this->conexao->getconnection()->prepare(
      "update carro set Nome_Carro=:nome,Image_Carro=:image,Marca_Carro=:marca,
       Preco_Carro=:preco ,Descricao_Carro=:descricao,Quantidade_Carro=:quantidade,
       Data_Carro=:data ,Cor_Carro=:cor Where Id_Carro=:id
     ");
   $update->execute(Array(
       ":id"=>$id,
       ":nome"=>$carro->getNome() ,
       ":image"=>$carro->getImage(),
       ":marca"=>$carro->getMarca(),
       ":preco"=>$carro->getPreco(),
       ":descricao"=>$carro->getDescricao(),
       ":quantidade"=>$carro->getQuantidade(),
       ":data"=>$carro->getData(),
       ":cor"=>$carro->getCor()
    ));
}
// fim  do update


// pegando todos os carros
public function  getAll(){
      $queries = $this->conexao->getconnection()->prepare("select * from Carro");
      $queries->execute() ;
      $error = 0;
      for(;$linha = $queries->fetch();):
          $lista[] =  $linha;
          $error =1;
      endfor;
     return $error == 0 ? null:$lista;

}

// fim da lista dos carros;


// lista de um Carro
public function getCarro($id){
    $queries =$this->conexao->getconnection()->prepare("select * from Carro where Id_Carro=:id");
    $queries->execute(Array(
       ":id"=>$id
    ));
    for(;$linha = $queries->fetch();):
         $lista[] = $linha;
    endfor;
    return $lista;
}
// fim da Lista;


}





?>
