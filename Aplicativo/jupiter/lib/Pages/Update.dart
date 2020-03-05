

import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:jupiter/Classes/Carro.dart';
import 'package:jupiter/Pages/Welcome.dart';

class Update extends StatefulWidget{
     final Carro carro ;
     Update({this.carro});
    Tela createState()=> new  Tela();
}
class Tela extends State<Update>{


  String _value = "";
  List<String> _values = new List<String>();


  TextEditingController  nome = new TextEditingController();
  TextEditingController  marca=  new TextEditingController();
  TextEditingController  preco = new TextEditingController();
  String cor = "";
  String dropmenu ;
  TextEditingController quantidade = new TextEditingController();
  bool mudounome = false;
  bool mudoumarca  = false;



  @override

  initState(){
    _values.addAll(["Vermelho","Preto" , "Azul"]);
    _value = _values.elementAt(0);
    super.initState();
  }
  void _onchanged(String value){
      setState(() {
          _value =  value;
      });
  }

  Widget build(BuildContext context) {
       return Scaffold(
            appBar: new AppBar(
                title: Text(widget.carro.nome),
                centerTitle: true,
            ),
          body: Container(
             width: double.infinity,
             height: 600,
             padding: EdgeInsets.only(
                 top: 30 ,
                 left: 5 ,
                 right: 5
             ),
              child: ListView(
                    children: <Widget>[

                      TextField(
                        controller: nome,
                        decoration: InputDecoration(
                          hintText: widget.carro.nome,
                          labelText: "Nome"
                        ),
                      ),
                      SizedBox(height: 5,) ,
                      TextField(
                        controller: marca,
                        decoration: InputDecoration(
                          hintText: widget.carro.marca,
                          labelText: "marca"
                        ),
                      ),
                      SizedBox(height: 5,) ,
                      TextField(
                        controller: preco,
                        decoration: InputDecoration(
                           labelText: "preco",
                          hintText: widget.carro.preco,
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
                ) ,
                      TextField(
                        controller: quantidade,
                        decoration: InputDecoration(
                          hintText: widget.carro.quantidade,
                          labelText: "quantidade"
                        ),
                      ),
                      SizedBox(height:10,) ,
                      Center(
                          child: RaisedButton(
                            onPressed:(){
                                 update(widget.carro.id, nome.text, marca.text,preco.text, _value, quantidade.text);
                            } ,
                            color: Colors.blue,
                            child: Text("Update",style: TextStyle(
                             color: Colors.white,
                          ),),),
                      )
                    ],
              ),
          ),

       );
  }

  void update(String id , String nome ,String marca,String preco, String cor ,String quantidade){
       String url ="http://192.168.43.75/jupiter/Apis_Jupiter/getall.php?funcao=update&id="+id+"&nome="+nome+"&marca="+marca+"&preco="+preco+"&cor="+cor+"&quantidade="+quantidade;
       var response  =  http.get(url).then((response){
            if(response.statusCode  >= 0  &&  response.statusCode <= 400){
                showDialog(context: context , child:AlertDialog(
                    content: Container(
                          width: 120,
                          height:80,
                          child: Column(
                              children: <Widget>[
                                  Text("Atualizado com Sucesso!") ,
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