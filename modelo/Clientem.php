<?php
    require "../configuracion/conexion.php";


    class Cliente{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos de zona
        //aqui se genera el alta de las zonas
        public function insertarc($nombre, $nombret, $codigo, $idzona, $direccion, $telefono)
        {
            $sql = "INSERT INTO cliente (nombre, nombretienda, codigo, idzona, direccion, telefono, estatus)
                    values ('$nombre', '$nombret','$codigo','$idzona', '$direccion', '$telefono','1')";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }


        //funcion para modificaciones 
        //este metodo es para modificar la infromacion de los zona
        public function modificarc($idcliente, $nombre, $nombret, $idzona, $direccion, $telefono)
        {
            $sql = "UPDATE cliente SET nombre='$nombre', nombretienda='$nombret', idzona='$idzona', direccion='$direccion', telefono='$telefono' 
            WHERE idcliente='$idcliente'";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }

        //Funcion para activar y desactivar zona
        public function desactivarc($idcliente)
        {
            $sql = "UPDATE cliente SET estatus='0'  WHERE idcliente='$idcliente'";
            return ejecutarConsulta($sql);
        }

        //Funcion para activar zona
        public function activarc($idcliente)
        {
            $sql = "UPDATE cliente SET estatus='1'  WHERE idcliente='$idcliente'";
            return ejecutarConsulta($sql);
        }

        //funcion para mostrar informacion
        public function mostrarc($idcliente)
        {
            $sql = "SELECT * FROM cliente WHERE idcliente='$idcliente'";
            return consultarFila($sql);
        }

        public function mostrarinfo($codigo)
        {
            $sql = "SELECT * FROM cliente WHERE codigo='$codigo'";
            return consultarFila($sql);
        }

        //funcion para listar preductos
        public function listarc()
        {
            $sql = "SELECT a.idcliente, a.nombre, a.nombretienda, a.codigo, a.idzona, c.nombrezona, a.direccion
            ,a.telefono,a.estatus FROM cliente a INNER JOIN zona c ON a.idzona=c.idzona";
            return ejecutarConsulta($sql);
        }
        

    }

?>