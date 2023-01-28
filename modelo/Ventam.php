<?php
    require "../configuracion/conexion.php";


    class Venta{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos de zona
        //aqui se genera el alta de las zonas
        public function insertarr( $idcliente, $total,  $idusuario, $fecha, $idproducto, $cantidad)
        {
            $sql = "INSERT INTO venta ( idcliente, total, idusuario, fecha)
                    values ('$idcliente','$total', '$idusuario', '$fecha')";
          //  ejecutarConsulta($sql);//se llama al metodo de conexion


            $idventanew=consulta_retornaid($sql);

           $num_elementos=0;
           $flag=true;

           while ($num_elementos < count($idproducto))
           {
               $sql_detalle= "INSERT INTO detalle_venta(cantidadv, id_producto, idventa)
               VALUES( '$cantidad[$num_elementos]','$idproducto[$num_elementos]','$idventanew')";
               ejecutarConsulta($sql_detalle) or $flag=false;
   
               $num_elementos=$num_elementos + 1;
           }
           return $flag;

        }

        //Funcion para activar y desactivar zona
        public function anular($idventa)
        {
            $sql = "UPDATE venta SET estatus='Anulado'  WHERE idventa='$idventa'";
            return ejecutarConsulta($sql);
        }

       

        //funcion para mostrar informacion
        public function mostrarr($idventa)
        {
            $sql = "SELECT v.idruta,DATE(r.fecha) as fecha, r.idzona, z.nombrezona
            as zona, v.idusuario, u.nombre as usuario, v.costoruta, v.estatus  FROM ruta r INNER JOIN  usuario u ON 
            v.idusuario=u.idusuario INNER JOIN zona z ON r.idzona=z.idzona WHERE idruta='$idruta'";
            return consultarFila($sql);
        }

        //funcion para listar productos
        public function listarv($correo)
        {
            $sql = "SELECT v.idventa, DATE(v.fecha) as fecha, v.idcliente, c.nombre as cliente, 
            v.total, v.estatus  FROM venta v INNER JOIN  usuario u ON 
            v.idusuario=u.idusuario INNER JOIN cliente c ON v.idcliente=c.idcliente WHERE correo='$correo'";
            return ejecutarConsulta($sql);
        }

        


        //funcion para listar los productos agregados a la ruta
        public function listardetalle($idventa)
        {
            $sql = "SELECT d.iddetallev, d.id_producto, p.nombre as producto, d.id_producto, p.precio as precio, d.cantidadv  FROM detalle_venta d INNER JOIN
            producto p ON d.id_producto=p.idproducto WHERE idventa='$idventa';";
            return ejecutarConsulta($sql);
        }

         //funcion para listar el producto de la ruta activa 
        public function listarproductosd($idusuario, $fecha)
        {
            $sql = "SELECT d.idruta, DATE(r.fecha) as fecha, d.idruta, r.idusuario as usuario,
            d.idproducto, p.nombre as producto, d.idproducto, p.precio as precio, d.cantidad FROM detalle_p d INNER JOIN ruta r
            ON d.idruta=r.idruta INNER JOIN producto p ON d.idproducto=p.idproducto 
            WHERE fecha='$fecha' AND r.idusuario='$idusuario' ";
            return ejecutarConsulta($sql);
        }


        //funcion para poder listar la tabla de producto vendidos y no vendidos en la ruta
        public function listarproductorest($idusuario, $fecha)
        {

             $sql = "SELECT d.idproducto, p.nombre as producto, d.idproducto, p.precio as precio, d.idruta, DATE(r.fecha) as fecha, 
            d.idruta, r.idusuario AS usuario, d.cantidad, d.pvendido FROM detalle_p d INNER 
            JOIN producto p ON d.idproducto=p.idproducto INNER JOIN ruta r ON d.idruta= r.idruta 
            WHERE r.fecha='$fecha' AND r.idusuario='$idusuario'";
            return ejecutarConsulta($sql);

        }


        

    }

?>














