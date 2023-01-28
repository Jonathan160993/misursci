<?php
    require "../configuracion/conexion.php";


    class Zona{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos de zona
        //aqui se genera el alta de las zonas
        public function insertarz($nombre, $poblado)
        {
            $sql = "INSERT INTO zona(nombrezona, poblado)
                    values ('$nombre','$poblado')";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }


        //funcion para modificaciones 
        //este metodo es para modificar la infromacion de los zona
        public function modificarz($idzona, $nombre, $poblado)
        {
            $sql = "UPDATE zona SET nombrezona='$nombre', poblado='$poblado' 
            WHERE idzona='$idzona'";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }

        //Funcion para activar y desactivar zona
        public function desactivarz($idzona)
        {
            $sql = "UPDATE zona SET estatus='0'  WHERE idzona='$idzona'";
            return ejecutarConsulta($sql);
        }

        //Funcion para activar zona
        public function activarz($idzona)
        {
            $sql = "UPDATE zona SET estatus='1'  WHERE idzona='$idzona'";
            return ejecutarConsulta($sql);
        }

        //funcion para mostrar informacion
        public function mostrarz($idzona)
        {
            $sql = "SELECT * FROM zona WHERE idzona='$idzona'";
            return consultarFila($sql);
        }

        //funcion para listar preductos
        public function listarz()
        {
            $sql = "SELECT * FROM zona";
            return ejecutarConsulta($sql);
        }

        public function filtrar()
        {
            $sql = "SELECT * FROM zona WHERE estatus=1";
            return ejecutarConsulta($sql);
        }

    }

?>