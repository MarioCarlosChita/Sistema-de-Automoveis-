<?php

class connection {

   // atributos usado na conexao
   private $server = "mysql:host=localhost;dbname=jupiter_db";
   private $user = "root";
   private $password  ="";

   // conexao com o banco de dado
   public function getconnection(){
       try{
          $conn  = new PDO($this->server,$this->user, $this->password);
       }catch(PDOException $error){
           echo $error->getMessage();
       }
        return $conn ;
   }
   // fim da conexao



}




?>
