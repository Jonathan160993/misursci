<?php
if(strlen(session_id()) < 1 )
session_start();

require_once "../modelo/Clientem.php";

    $cliente = new Cliente();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idcliente = isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $nombret = isset($_POST["nombretienda"])? limpiarCadena($_POST["nombretienda"]):"";
    $zona = isset($_POST["idzona"])? limpiarCadena($_POST["idzona"]):"";
    $codigo = isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
    $direccion = isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
    $telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
   


    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($idcliente)) {
             
                $rstp=$cliente->insertarc($nombre, $nombret, $codigo, $zona, $direccion, $telefono);
                echo $rstp ? "Cliente guardado": "¡¡Algo Fallo!! 
                              No se guardo cliente";
            }else {
                $rstp=$cliente->modificarc($idcliente, $nombre, $nombret, $zona, $direccion, $telefono);
                echo $rstp ? "cliente Actualizado": "¡¡Algo Fallo!! 
                              No se actualizo el cliente";
            }
        break;

        case 'desactivar':

            $rstp=$cliente->desactivarc($idcliente);
            echo $rstp ? "cliente Desactivado": "¡¡Algo Fallo!! 
                          No se desactivara la cliente";
        break;

        case 'activar':
            $rstp=$cliente->activarc($idcliente);
            echo $rstp ? "Cliente activo": "¡¡Algo Fallo!! No se activara el cliente";
        break;

        case 'mostrar':
            $rstp=$cliente->mostrarc($idcliente);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            $rstp=$cliente->listarc();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estatus)?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idcliente.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"> 
                         <i class="fa fa-close"></i></button>':
                         '<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idcliente.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"> 
                         <i class="fa fa-check"></i></button>', 

                    "1"=>$reg->nombre,
                    "2"=>$reg->nombretienda,
                    "3"=>$reg->codigo,
                    "4"=>$reg->nombrezona,
                    "5"=>$reg->direccion,
                    "6"=>$reg->telefono,
                    "7"=>($reg->estatus)?'<span class="label bg-green">Activado</span>':
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





    }
?>