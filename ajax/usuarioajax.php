<?php
session_start(); 
require_once "../modelo/Usuariom.php";

    $usuario = new Usuario();

    //validacion de una solo linea para obtener la informacion de un formulario
    $idusuario = isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
    $nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
    $cargo = isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
    $telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
    $correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
    $pass = isset($_POST["pass"])? limpiarCadena($_POST["pass"]):"";

    switch ($_GET["op"]) {

        case 'guardaryeditar':

            $passhash = hash("SHA256", $pass);
            if (empty($idusuario)) {
             
                $rstp=$usuario->insertaru($nombre, $cargo, $telefono, 
                $correo, $passhash, $_POST['permiso']);
                echo $rstp ? "Usuario guardado": "¡¡Algo Fallo!! 
                              No se guardaron todos los datos del usuario";
            }else {
                $rstp=$usuario->modificaru($idusuario, $nombre, $cargo,  $telefono, 
                                           $correo, $passhash, $_POST['permiso']);
                echo $rstp ? "Usuario Actualizado": "¡¡Algo Fallo!! 
                              No se actualizo el usuario";
            }
        break;

        case 'desactivar':

            $rstp=$usuario->desactivaru($idusuario);
            echo $rstp ? "Usuario Desactivado": "¡¡Algo Fallo!! 
                          No se desactivara la Usuario";
        break;

        case 'activar':
            $rstp=$usuario->activaru($idusuario);
            echo $rstp ? "Usuario activo": "¡¡Algo Fallo!! No se activara el usuario";
        break;

        case 'mostrar':
            $rstp=$usuario->mostraru($idusuario);
            echo json_encode($rstp); //codificacion del resultado de la consulta con json
        break;
        
        case 'listar':
            $rstp=$usuario->listaru();
            //arreglo donde se guardan los datos
            $datos= Array();

            //ciclo para poder mostrar los datos listados
            while ($reg=$rstp->fetch_object()) {
                //aqui se extraen los datos para ser mostrados
                $datos[]=array(
                    //botcoon para editar los registros
                    "0"=>($reg->estatus)?'<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idusuario.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"> 
                         <i class="fa fa-close"></i></button>':
                         '<button class="btn btn-warning" 
                       onclick="mostrar('.$reg->idusuario.')"> <i class="fa fa-pencil"></i></button> '.
                       ' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"> 
                         <i class="fa fa-check"></i></button>', 

                    "1"=>$reg->nombre,
                    "2"=>$reg->cargo,
                    "3"=>$reg->telefono,
                    "4"=>$reg->correo,
                    "5"=>($reg->estatus)?'<span class="label bg-green">Activado</span>':
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

        case 'permisos':
            //obtener permisos para los usuarios desde la tabla permiso
            require_once "../modelo/Permisosm.php";
            $permiso = new Permisos();
            $rpst = $permiso->listarper();

            //aqui se van a obtener los permisos asignado a los usuarios
            $id=$_GET['id']; //aqui se va a recibir el id del usuario
            //y aqui se guardan los permisos marcados
            $marcados = $usuario->permisosmar($id);
            //el array nos permite almacenar todos los eprmisos marcados
            $valores=array();
            while ($perm = $marcados->fetch_object()) {
                array_push($valores, $perm->idpermiso);
            }
            //aqui se muestran los permisos en una lista
            while ($reg=$rpst->fetch_object()) 
            {   
                //estructura condicional
                $flag=in_array($reg->idpermiso, $valores)?'checked':'';
                echo '<li> <input type="checkbox"'.$flag.' name="permiso[]" value="'.$reg->idpermiso.'">
                '.$reg->nombre.'</li>';
            }

        break;

        case 'verificar':

            //aqui se verifica el acceso a los ususarios se reciven las variables para ser
            //comparadas
            $correoa=$_POST['correo'];
            $passa=$_POST['pass'];

            //encriptamos la contraseña para poder compararla
           $passhash=hash("SHA256", $passa);

            $rpst=$usuario->verificar($correoa, $passhash);
            
            //se declara un objeto fetch para guardar los campos como propiedades del objeto cada campo
            $fetch=$rpst->fetch_object();

            if (isset($fetch)) 
            {
                //se declaran las variebles de sesion
                $_SESSION['idusuario']=$fetch->idusuario;
                $_SESSION['nombre']=$fetch->nombre;
                $_SESSION['correo']=$fetch->correo;

                //aqui se obtendran los permisos de los usuarios
                //se declara una variable marcado donde se van a obtener los permisos
                $marcados = $usuario->permisosmar($fetch->idusuario);

                //se genera un array para poder almacenar los permisos marcados
                $valores=array();

                //se declara un ciclo while para ir almacenando los permisos en el arreglo
                while ($per = $marcados->fetch_object()) 
                {
                    array_push($valores, $per->idpermiso);
                }
                //aqui se validan las sesiones y se verifican cuales son los permisos 
                
                in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
                in_array(2,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
                in_array(3,$valores)?$_SESSION['administracion']=1:$_SESSION['compras']=0;
                in_array(4,$valores)?$_SESSION['empleados']=1:$_SESSION['ventas']=0;
                in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
                
            }
            echo json_encode($fetch);

        break;
            
        case 'salir':
            //limpiamos las variables
            session_unset();
            //destruimos la sesion
            session_destroy();
            //redireccionamos al login
            header ("Location: ../index.php");
        break;
            


    }
?>