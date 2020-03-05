class Carro{
   String nome;
   String id;
   String marca;
   String  cor ;
   String  descricao ;
   String preco ;
   String  quantidade;

   Carro({this.id , this.nome, this.marca, this.cor, this.descricao, this.preco,
       this.quantidade});


   factory Carro.jsonFormatter(Map<String, dynamic> map){
       return Carro(
            nome: map['Nome_Carro'],
            marca: map['Marca_Carro'] ,
            cor: map['Cor_Carro'] ,
            descricao: map['Descricao_Carro'] ,
            preco: map['Preco_Carro'],
            quantidade: map['Quantidade_Carro'],
            id:map['Id_Carro']
       );
   }

   String getNome(){
      return this.nome;
   }

   String getMarca(){
     return this.marca;
   }
   String getId(){
       return this.id;
   }
   String getCor(){
     return this.cor;
   }

   String getDescricao(){
     return this.descricao;
   }
   String getPreco(){
     return this.preco;
   }

   String getQuantidade(){
       return this.quantidade;
   }


}

