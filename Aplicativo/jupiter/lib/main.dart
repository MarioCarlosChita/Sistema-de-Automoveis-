import 'package:flutter/material.dart';
import 'Pages/Welcome.dart';

void main()=>runApp(new MaterialApp(
   home: Index(),
   debugShowCheckedModeBanner: false,
));

class Index extends StatefulWidget{
     Template createState()=>  Template();
}

class Template extends State<Index>{


  bool circule = false;

  @override
  Widget build(BuildContext context) {
      return Scaffold(

        body: Stack(
             children: <Widget>[
               circule? Positioned(
                 top: 300,
                 left: 160,
                 child:CircularProgressIndicator(
                 )
               ) :Container(),
               Positioned(
                   top: 180,
                   left: 50,
                 child:Container(
                     padding: EdgeInsets.only(
                       top: 120 ,
                     ),
                     child:Text("Sistema de Automoveis" ,style: TextStyle(
                       color: Colors.blue ,
                       fontSize: 23 ,
                       fontWeight: FontWeight.bold ,
                     ),)
                 ),

               ) ,
               Center(
                 child: Container(
                   padding: EdgeInsets.only(
                     top: 120 ,
                   ),
                   child:ButtonTheme(
                     minWidth: 200,
                     height: 60,
                     child: FlatButton(
                         onPressed: (){
                           loading();
                         },
                         shape: RoundedRectangleBorder(
                             borderRadius: BorderRadius.circular(10) ,
                             side: BorderSide(
                                 color: Colors.blueAccent
                             )
                         ),
                         child:Text('Entrar' , style: TextStyle(
                           color: Colors.black ,
                         ),)
                     ),
                   ) ,
                 ),
               )
             ],
        ),
      );
  }

  void loading(){
      setState(() {
          circule =  true;
      });

      Future.delayed(Duration(seconds: 5),(){
         Navigator.of(context).pushAndRemoveUntil(MaterialPageRoute(builder:(context)=>Welcome()), (Route<dynamic> route) => false);
      });
  }
}

