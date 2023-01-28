<?php
require_once "../modelo/Cventasm.php";
  
    $cventas = new Cventas();
    $idventa= isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
    
    switch ($_GET["op"]){   

    case 'listar':
            $rstp=$cventas->listarv();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    
                    "0"=>$reg->fecha,
                    "1"=>$reg->tienda,
                    "2"=>'<p>$ '.$reg->total.'</p>',
                    "3"=>$reg->chofer,
                    "4"=>'<a data-toggle="modal" href="#myModald"><button class="btn btn-warning" 
                    onclick="listardetalle('.$reg->idventa.')"> <i class="fa fa-eye"></i></button> </a>'
                );
            }

            $resultado = array(
                "sEcho"=>1, //informacion para el datatable
                "iTotalRecords"=>count($datos),//envia el total de los registros al datatable
                "iTotalDisplayRecords"=>count($datos),//envia el total de registros a visualizar
                "aaData"=>$datos);
                
            echo json_encode($resultado);

        break;

        case 'listardetalleventa': 
           
            require_once "../modelo/Ventam.php";

            $venta = new Venta();

            $rspt = $venta->listardetalle($idventa);

             //ciclo para poder mostrar los datos listados
             while ($reg=$rspt->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>$reg->producto, 
                    "1"=>$reg->cantidadv,
                    "2"=>$reg->precio
                    
                );
            }

            $resultado = array(
                "sEcho"=>1, //informacion para el datatable
                "iTotalRecords"=>count($datos),//envia el total de los registros al datatable
                "iTotalDisplayRecords"=>count($datos),//envia el total de registros a visualizar
                "aaData"=>$datos);
                
            echo json_encode($resultado);




    }
?>