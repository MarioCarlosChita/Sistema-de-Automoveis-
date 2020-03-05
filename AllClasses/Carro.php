<?php

  class Carro{

        private $id_Carro ;
        private $Nome_Carro;
        private $Image_Carro;
        private $Marca_Carro;
        private $Descricao_Carro;
        private $Preco_Carro;
        private $Cor_Carro;
        private $Quantidade_Carro;
        private $Data_Carro;

        public function __construct($nome,$image,$marca ,$descricao,$preco ,$quantidade ,$data ,$cor)
        {
            $this->Image_Carro =$image;
            $this->Nome_Carro = $nome;
            $this->Descricao_Carro = $descricao;
            $this->Marca_Carro =$marca ;
            $this->Cor_Carro =  $cor ;
            $this->Preco_Carro =$preco;
            $this->Quantidade_Carro = $quantidade;
            $this->Data_Carro = $data;
        }

        public function getImage(){return $this->Image_Carro;}
        public function getId(){return $this->Id_Carro;}
        public function getNome(){return $this->Nome_Carro;}
        public function getMarca(){return $this->Marca_Carro;}
        public function getPreco(){return $this->Preco_Carro;}
        public function getDescricao(){return $this->Descricao_Carro;}
        public function getCor(){return $this->Cor_Carro;}
        public function getQuantidade(){return $this->Quantidade_Carro;}
        public function getData(){return $this->Data_Carro;}


       public function setImage($image){$this->Image_Carro=$image;}
       public function setId($id){$this->Id_Carro = $id;}
       public function setNome($nome){ $this->Nome_Carro = $nome;}
       public function setCor($cor){$this->Cor_Carro = $cor;}
       public function setDescricao($descricao){$this->Descricao_Carro = $descricao;}
       public function setMarca($marca){$this->Marca_Carro =$marca ;}
       public function setPreco($preco){$this->Preco_Carro =$preco;}
       public function setQuantidade($quantidade){  $this->$Quantidade_Carro = $quantidade;}
       public function setData($data){$this->Data_Carro = $data;}




  }







?>
