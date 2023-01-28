<?php
    require "../configuracion/conexion.php";


    class Usuario{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos de zona
        //aqui se genera el alta de las zonas
        public function insertaru($nombre, $cargo, $telefono, $correo,  $pass, $permisos)
        {
            $sql = "INSERT INTO usuario (nombre, cargo, telefono, correo,  pass)
                    values ('$nombre','$cargo','$telefono', '$correo', '$pass')";
         //   return ejecutarConsulta($sql);//se llama al metodo de conexion
         $idusuarionew=consulta_retornaid($sql);

         //codigo para 
         $num_elementos=0;
        $flag=true;
        while ($num_elementos < count($permisos))
        {
            $sql_detalle= "INSERT INTO permiso_usuario(idusuario,idpermiso)
            VALUES('$idusuarionew', '$permisos[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $flag=false;

            $num_elementos=$num_elementos + 1;
        }
        return $flag;

        }

        //funcion para modificaciones 
        //este metodo es para modificar la infromacion de los zona
        public function modificaru($idusuario, $nombre, $cargo, $telefono, $correo, $pass, $permisos)
        {
            $sql = "UPDATE usuario SET nombre='$nombre', cargo='$cargo', telefono='$telefono',
            correo='$correo', pass='$pass' 
            WHERE idusuario='$idusuario'";
            ejecutarConsulta($sql);//se llama al metodo de conexion
            $sqldel= "DELETE FROM permiso_usuario WHERE idusuario='$idusuario'";
            ejecutarConsulta($sqldel);

            $num_elementos=0;
            $flag=true;
            while ($num_elementos < count($permisos))
            {
                $sql_detalle= "INSERT INTO permiso_usuario(idusuario,idpermiso)
                VALUES('$idusuario', '$permisos[$num_elementos]')";
                ejecutarConsulta($sql_detalle) or $flag=false;
    
                $num_elementos=$num_elementos + 1;
            }
            return $flag;

        }

        //Funcion para activar y desactivar zona
        public function desactivaru($idusuario)
        {
            $sql = "UPDATE usuario SET estatus='0'  WHERE idusuario='$idusuario'";
            return ejecutarConsulta($sql);
        }

        //Funcion para activar usuario
        public function activaru($idusuario)
        {
            $sql = "UPDATE usuario SET estatus='1'  WHERE idusuario='$idusuario'";
            return ejecutarConsulta($sql);
        }

        //funcion para mostrar informacion
        public function mostraru($idusuario)
        {
            $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
            return consultarFila($sql);
        }   
        
        public function listaru()
        {
            $sql = "SELECT * FROM usuario";
            return ejecutarConsulta($sql);
        }


        //esta funcion permite dejar la marca en el chackbox de los permisos 
        //que tiene el usuario cuando se quiere editar
        public function permisosmar($idusuario)
        {
            $sql="SELECT * FROM permiso_usuario WHERE idusuario='$idusuario'";
            return ejecutarConsulta($sql);
        }

        //funcion para verificar el acceso de los usuarios
       public function verificar($correo, $pass)
        {
            $sql = "SELECT idusuario, nombre, cargo, telefono, correo 
                    FROM usuario
                     WHERE correo='$correo' AND pass='$pass' AND estatus='1'";
            return ejecutarConsulta($sql);
            
        }

    }

?>