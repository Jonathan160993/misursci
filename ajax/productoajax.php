<?php
require_once "../modelo/Producto.php";

    $producto = new Producto();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idproducto = isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $precio = isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
    $existencia = isset($_POST["existencia"])? limpiarCadena($_POST["existencia"]):"";

    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($idproducto)) {
             
                $rstp=$producto->insertarp($nombre, $precio, $existencia);
                echo $rstp ? "Producto Guardado": "¡¡Algo Fallo!! 
                              No se guardo el producto";
            }else {
                $rstp=$producto->modificarp($idproducto, $nombre, $precio, $existencia);
                echo $rstp ? "Producto Actualizado": "¡¡Algo Fallo!! 
                              No se actualizo el producto";
            }
        break;

        case 'desactivar':

            $rstp=$producto->desactivarp($idproducto);
            echo $rstp ? "Producto Desactivado": "¡¡Algo Fallo!! 
                          No se desactivar el producto";
        break;

        case 'activar':
            $rstp=$producto->activarp($idproducto);
            echo $rstp ? "Producto Activo": "¡¡Algo Fallo!! No se activar el producto";
        break;

        case 'mostrar':
            $rstp=$producto->mostrarp($idproducto);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            $rstp=$producto->listarp();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estado)?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idproducto.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="desactivar('.$reg->idproducto.')"> 
                         <i class="fa fa-close"></i></button>':
                         '<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idproducto.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-primary" onclick="activar('.$reg->idproducto.')"> 
                         <i class="fa fa-check"></i></button>', 

                    "1"=>$reg->nombre,
                    "2"=>'<p>$ '.$reg->precio.'</p>',
                    "3"=>$reg->existencia,
                    "4"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivado</span>'
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