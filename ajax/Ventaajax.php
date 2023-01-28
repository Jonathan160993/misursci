<?php
if(strlen(session_id()) < 1 )
    session_start();

require_once "../modelo/Ventam.php";

    $venta = new Venta();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idventa= isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
    $idcliente = isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
    $idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
    $fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
    $total = isset($_POST["costoVenta"])? limpiarCadena($_POST["costoVenta"]):""; 
    $codigo = isset($_POST["codigob"])? limpiarCadena($_POST["codigob"]):"";
    $correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
    

    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($idventa)) {
             
                $rstp=$venta->insertarr($idcliente, $total ,$idusuario, $fecha,$_POST['idproducto'],$_POST['cantidadp'] );
                echo $rstp ? "Venta Realizada": "¡¡Algo Fallo!! 
                              No se guardo ruta";
            }else {
            }
        break;

        case 'anular':

            $rstp=$ruta->anular($idruta);
            echo $rstp ? "Venta anulada": "¡¡Algo Fallo!! 
                          No se anulo registro de ruta";
        break;

    case 'mostrar':
            $rstp=$ruta->mostrarr($idruta);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            
            $rstp=$venta->listarv($correo);

            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estatus)?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idventa.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="anular('.$reg->idventa.')"> 
                         <i class="fa fa-close"></i></button>'.' <a data-toggle="modal" href="#myModald"><button class="btn btn-warning" 
                         onclick="listardetalle('.$reg->idventa.')"> <i class="fa fa-eye"></i></button> </a>':
                         '<button class="btn btn-warning" onclick="mostrar('.$reg->idventa.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <a data-toggle="modal" href="#myModald"><button class="btn btn-warning" 
                         onclick="listardetalle('.$reg->idventa.')"> <i class="fa fa-eye"></i></button> </a>',
                       

                    "1"=>$reg->fecha,
                    "2"=>$reg->cliente,
                    "3"=>$reg->total,
                    "4"=>($reg->estatus)?'<span class="label bg-green">Aceptado</span>':
                    '<span class="label bg-red">Anulado</span>'
                );
            }

            $resultado = array(
                "sEcho"=>1, //informacion para el datatable
                "iTotalRecords"=>count($datos),//envia el total de los registros al datatable
                "iTotalDisplayRecords"=>count($datos),//envia el total de registros a visualizar
                "aaData"=>$datos);
                
            echo json_encode($resultado);

        break;

        case "buscar":
            require_once "../modelo/Clientem.php";
            $cliente = new Cliente();

            $rstp = $cliente->mostrarinfo($codigo);
            
            echo json_encode($rstp);

        break;
    

        case 'listarArticulo':
            
             
            $rstp=$venta->listarproductosd($idusuario, $fechaactual);
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>'<button class="btn btn-warning"
                    onclick="agregarp('.$reg->idproducto.',\''.$reg->producto.'\',\''.$reg->cantidad.'\',
                    \''.$reg->precio.'\')"><span class="fa fa-plus"></span></button>', 
                    "1"=>$reg->producto,
                    "2"=>'<p>$ '.$reg->precio.'</p>',
                    "3"=>$reg->cantidad
                );
            }

            $resultado = array(
                "sEcho"=>1, //informacion para el datatable
                "iTotalRecords"=>count($datos),//envia el total de los registros al datatable
                "iTotalDisplayRecords"=>count($datos),//envia el total de registros a visualizar
                "aaData"=>$datos);
                
            echo json_encode($resultado);

        break;    

        case 'listarArticuloDisponible':
            
           
           $rstp=$venta->listarproductorest($idusuario, $fecha);
           //arreglo donde se guardan los datos
           $datos= Array();

           //ciclo para poder mostrar los datos listados
           while ($reg=$rstp->fetch_object()) {
               //aqui se extraen los datos para ser mostrados
               $datos[]=array(
                   //botcoon para editar los registros
                   "0"=>$reg->producto, 
                   "1"=>'<p>$ '.$reg->precio.'</p>',
                   "2"=>$reg->cantidad,
                   "3"=>$reg->pvendido
               );
           }

           $resultado = array(
               "sEcho"=>1, //informacion para el datatable
               "iTotalRecords"=>count($datos),//envia el total de los registros al datatable
               "iTotalDisplayRecords"=>count($datos),//envia el total de registros a visualizar
               "aaData"=>$datos);
               
           echo json_encode($resultado);

       break;   

        case 'listarDetalle':
            $rstp=$venta->listardetalle($idventa);
            
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
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

        break;


    }
?>