<?php
if(strlen(session_id()) < 1 )
    session_start();

require_once "../modelo/Rutam.php";

    $ruta = new Ruta();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idruta= isset($_POST["idruta"])? limpiarCadena($_POST["idruta"]):"";
    $idzona = isset($_POST["idzona"])? limpiarCadena($_POST["idzona"]):"";
    $idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
    $fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
    $costoruta = isset($_POST["costoRuta"])? limpiarCadena($_POST["costoRuta"]):""; 


    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($idruta)) {
             
                $rstp=$ruta->insertarr($idzona, $idusuario, $fecha,$costoruta,$_POST['idproducto'],$_POST['cantidadp'] );
                echo $rstp ? "ruta guardada": "¡¡Algo Fallo!! 
                              No se guardo ruta";
            }else {
            }
        break;

        case 'anular':

            $rstp=$ruta->anular($idruta);
            echo $rstp ? "Ruta anulada": "¡¡Algo Fallo!! 
                          No se anulo registro de ruta";
        break;

    case 'mostrar':
            $rstp=$ruta->mostrarr($idruta);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            $rstp=$ruta->listarr();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estatus=='Aceptado')?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idruta.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="anular('.$reg->idruta.')"> 
                         <i class="fa fa-close"></i></button>'.' <a data-toggle="modal" href="#myModald"><button class="btn btn-warning" 
                         onclick="listardetalle('.$reg->idruta.')"> <i class="fa fa-eye"></i></button> </a>':
                         '<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idruta.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <a data-toggle="modal" href="#myModald"><button class="btn btn-warning" 
                         onclick="listardetalle('.$reg->idruta.')"> <i class="fa fa-eye"></i></button> </a>',
                       

                    "1"=>$reg->fecha,
                    "2"=>$reg->zona,
                    "3"=>$reg->usuario,
                    "4"=>'<p>$ '.$reg->costoruta.'</p>',
                    "5"=>($reg->estatus=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
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

        case "filtra":
            require_once "../modelo/Zonam.php";
            $zona = new Zona();

            $rstp = $zona->filtrar();
            
            while ($reg = $rstp->fetch_object())
            {   
                echo '<option value=' .$reg->idzona. '>' .$reg->nombrezona. 
                '</option>';
            }

        break;
    
        case 'listaru':
            require_once "../modelo/Usuariom.php";
            $usuario = new Usuario();

            $rstp= $usuario->listaru();
            while ($reg = $rstp->fetch_object())
             {
                echo '<option value=' .$reg->idusuario. '>' .$reg->nombre. 
                '</option>';
            }



        break;

        case 'listarz':
            require_once "../modelo/Zonam.php";
            $zona = new Zona();

            $rstp= $zona->listarz();
            while ($reg = $rstp->fetch_object())
             {
                echo '<option value=' .$reg->idzona. '>' .$reg->nombrezona. 
                '</option>';
            }

        break;

        case 'listarArticulo':
            require_once "../modelo/Producto.php";

            $producto = new Producto();

            $rstp=$producto->listarpactivo();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>'<button class="btn btn-warning"
                    onclick="agregarp('.$reg->idproducto.',\''.$reg->nombre.'\',\''.$reg->existencia.'\',
                    \''.$reg->precio.'\')"><span class="fa fa-plus"></span></button>', 
                    "1"=>$reg->nombre,
                    "2"=>'<p>$ '.$reg->precio.'</p>',
                    "3"=>$reg->existencia
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
            $rstp=$ruta->listardetalle($idruta);
            
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>$reg->producto, 
                    "1"=>$reg->cantidad,
                    
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