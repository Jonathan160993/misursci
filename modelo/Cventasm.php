<?php
    require "../configuracion/conexion.php";


    class Cventas{

        //se define el constructor
        public function __cosntruct()
        {

        }
        //funcion donde se ejecuta la consulta para listar las ventas realizadas
        //El administrador es el que podra visualizar las ventas y podra filtararlas     
        public function listarv()
        {
            $sql = "SELECT  DATE(v.fecha) as fecha, v.idcliente, c.nombretienda as tienda, v.total, 
            v.idusuario, u.nombre as chofer,v.idventa  FROM venta v INNER JOIN usuario u ON v.idusuario=u.idusuario
             INNER JOIN cliente c on v.idcliente=c.idcliente";
            return ejecutarConsulta($sql);
        }

    }

?>