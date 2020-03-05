
import 'package:flutter/material.dart';
import 'package:jupiter/Classes/Carro.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'dart:io';

import 'package:jupiter/Pages/Update.dart';

class Welcome extends StatefulWidget{
    IndexPage createState()=> IndexPage();
}
class IndexPage extends State<Welcome>{
   List<Carro>  listaCarro  = [];
   String _value = "";
   List<String> _values = new List<String>();

   TextEditingController nome =   new TextEditingController();
   TextEditingController marca =  new TextEditingController();
   TextEditingController preco =  new TextEditingController();
   String cor = "";
   String dropmenu ;
   TextEditingController quantidade = new TextEditingController();


  @override
  initState(){
    _values.addAll(["Vermelho","Preto" , "Azul"]);
    _value = _values.elementAt(0);
    super.initState();
    GetAll();
  }
   void _onchanged(String value){
     setState(() {
       _value =  value;
     });
   }
  Widget build(BuildContext context) {
      return Scaffold(
           appBar: new AppBar(
               title: Text('Lista de Automoveis'),
                centerTitle: true,
                actions: <Widget>[
                  IconButton(icon: Icon(Icons.more_vert ,color: Colors.white,), onPressed: (){

                  })
                ],
           ),
        body: Container(
            padding: EdgeInsets.only(
               top: 20 ,
             ),
            child: listaCarro.length == 0?Center(
               child: CircularProgressIndicator(
               ),
            ):ListView.builder(
                 itemCount: listaCarro.length,
                  itemBuilder: (context , index){
                  return InkWell(
                    onTap: (){
                       Navigator.of(context).push(MaterialPageRoute(builder: (context)=> new Update(carro: listaCarro[index],)));
                    },
                    child: Container(
                        padding: EdgeInsets.only(
                           top: 10 , 
                        ),
                      child: Card(
                           child: ListTile(
                               title: Text(listaCarro[index].nome),
                               subtitle: Row(
                                  children: <Widget>[
                                     Text("Marca: ${listaCarro[index].marca}",) ,
                                     SizedBox(width: 4,),
                                     Text("Quant: ${listaCarro[index].quantidade}",) ,
                                     SizedBox(width: 4,),
                                     Text("Preco: ${listaCarro[index].preco}",) ,
                                  ],
                               ),
                                trailing: IconButton(icon: Icon(Icons.delete ,color: Colors.blue,), onPressed:(){
                                  Deletar(listaCarro[index].id);
                                }),
                           ),
                      ),
                    ),
                );
            }),
        ),
        floatingActionButton: FloatingActionButton(
          onPressed: (){
            showDialog(context: context , child: AlertDialog(
              content: Container(
                width: 300,
                height: 450,
                child: ListView(
                    children: <Widget>[
                      Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        mainAxisAlignment: MainAxisAlignment.start,
                        children: <Widget>[
                          TextField(
                            controller: nome,
                            decoration: InputDecoration(
                              hintText: "Nome",
                            ),
                          ),
                          SizedBox(height: 5,) ,
                          TextField(
                            controller: marca,
                            decoration: InputDecoration(
                              hintText: "Marca",
                            ),
                          ),
                          SizedBox(height: 5,) ,
                          TextField(
                            controller: preco,
                            decoration: InputDecoration(
                              hintText: "preco",
                            ),
                          ),
                          SizedBox(height:3,),
                          Text('Cor') ,
                          DropdownButton<String>(
                              value: _value,
                              items: _values.map((String value){
                                return DropdownMenuItem(
                                    value: value,
                                    child: Text(value)
                                );
                              }).toList(),
                              onChanged: (String value){
                                _onchanged(value);
                              }
                          ),
                          TextField(
                            controller: quantidade,
                            decoration: InputDecoration(
                              hintText: "Quantidade",
                            ),
                          ),
                          SizedBox(height:30,) ,
                          Center(
                            child: RaisedButton(
                              onPressed:(){
                                  Navigator.of(context).pop();
                                  adiocinar(nome.text ,marca.text,preco.text, _value ,quantidade.text);
                              },
                              color: Colors.blue,
                              child: Text("adicionar",style: TextStyle(
                                color: Colors.white,
                              ),),),
                          )
                        ],
                      )
                    ],
                ),
              ),
            ));
          },
          backgroundColor: Colors.blue,
          child: Icon(Icons.add, color: Colors.white,),
        ),
      );
  }

  
  void GetAll() async{
       String url = "http://192.168.43.75/jupiter/Apis_Jupiter/getall.php?funcao=lista";
       var response = await http.get(url ,headers: {"Content-Type":"application/json"});
       if(response.statusCode >=200 &&  response.statusCode<=400){
           List<dynamic> maps = json.decode(response.body);
           for(int  i = 0 ;  i<maps.length ;  ++i)
              {
                setState(() {
                  listaCarro.add(Carro.jsonFormatter(maps[i]));
                });
              }

       }
  }

  void  Deletar(String id) async{
    showDialog(context: context , child: AlertDialog(
         content: Container(
               width: 200,
               height: 80,
              child: Column(
                  children: <Widget>[
                      Text('Desejas Deletar o Automovel?'),
                     Row(
                         children: <Widget>[
                             FlatButton(
                                 onPressed: (){
                                     Navigator.of(context).pop();
                                 } ,
                                 child: Text('No')
                             ) ,
                           FlatButton(
                               onPressed: (){
                                 String url = "http://192.168.43.75/jupiter/Apis_Jupiter/getall.php?funcao=deletar&id="+id;
                                 var response =  http.get(url ,headers: {"Content-Type":"application/json"});
                                 Navigator.of(context).pushAndRemoveUntil(MaterialPageRoute(builder:(context)=>Welcome()), (Route<dynamic> route) => false);
                               },
                               child: Text('Yes')
                           ) ,

                         ],
                     )
                  ],
              ),
         ),
    ));
  }

   void adiocinar(String nome ,String marca,String preco, String cor ,String quantidade){
     String url ="http://192.168.43.75/jupiter/Apis_Jupiter/getall.php?funcao=add&nome="+nome+"&marca="+marca+"&preco="+preco+"&cor="+cor+"&quantidade="+quantidade;
     var response  =  http.get(url).then((response){
       if(response.statusCode  >= 0  &&  response.statusCode <= 400){
         showDialog(context: context , child:AlertDialog(
           content: Container(
             width: 120,
             height:80,
             child: Column(
               children: <Widget>[
                 Text("Adicionado com Sucesso!") ,
                 SizedBox(height:10,) ,
                 FlatButton(
                   onPressed: (){
                     Navigator.of(context).pushAndRemoveUntil(MaterialPageRoute(builder:(context)=>Welcome()), (Route<dynamic> route) => false);
                   },
                   child: Text('ok') ,
                 )
               ],
             ),
           ),
         ));
       }
     });
   }


}