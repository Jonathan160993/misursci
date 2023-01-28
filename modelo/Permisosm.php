<?php
    require "../configuracion/conexion.php";


    class Permisos{

        //se define el constructor
        public function __cosntruct()
        {

        }
        //funcion para listar permisos 
    //El administrador no podra gestionar o agregar un permiso, el unico que puede sera el desarrollador    
        public function listarper()
        {
            $sql = "SELECT * FROM permisos";
            return ejecutarConsulta($sql);
        }

    }

?>