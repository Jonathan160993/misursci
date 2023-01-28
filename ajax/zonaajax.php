<?php
if(strlen(session_id()) < 1 )
session_start();

require_once "../modelo/Zonam.php";

    $zona = new Zona();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idzona = isset($_POST["idzona"])? limpiarCadena($_POST["idzona"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $poblado = isset($_POST["poblado"])? limpiarCadena($_POST["poblado"]):"";
   

    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($idzona)) {
             
                $rstp=$zona->insertarz($nombre, $poblado);
                echo $rstp ? "Zona Guardada": "¡¡Algo Fallo!! 
                              No se guardo zona";
            }else {
                $rstp=$zona->modificarz($idzona, $nombre, $poblado);
                echo $rstp ? "Zona  Actualizada": "¡¡Algo Fallo!! 
                              No se actualizo la zona";
            }
        break;

        case 'desactivar':

            $rstp=$zona->desactivarz($idzona);
            echo $rstp ? "Zona Desactivada": "¡¡Algo Fallo!! 
                          No se desactivar la zona";
        break;

        case 'activar':
            $rstp=$zona->activarz($idzona);
            echo $rstp ? "Zona Activa": "¡¡Algo Fallo!! No se activar la zona";
        break;

        case 'mostrar':
            $rstp=$zona->mostrarz($idzona);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            $rstp=$zona->listarz();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estatus)?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idzona.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="desactivar('.$reg->idzona.')"> 
                         <i class="fa fa-close"></i></button>':
                         '<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idzona.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-primary" onclick="activar('.$reg->idzona.')"> 
                         <i class="fa fa-check"></i></button>', 

                    "1"=>$reg->nombrezona,
                    "2"=>$reg->poblado,
                    "3"=>($reg->estatus)?'<span class="label bg-green">Activado</span>':
                    '<span class="label bg-red">Desactivada</span>'
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