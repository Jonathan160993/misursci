<?php
    require "../configuracion/conexion.php";


    class Ruta{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos de zona
        //aqui se genera el alta de las zonas
        public function insertarr($idzona, $idusuario, $fecha, $costoruta, $idproducto, $cantidad)
        {
            $sql = "INSERT INTO ruta (idzona, idusuario, fecha, costoruta, estatus)
                    values ('$idzona','$idusuario', '$fecha', '$costoruta', 'Aceptado')";
          //  ejecutarConsulta($sql);//se llama al metodo de conexion


            $idrutanew=consulta_retornaid($sql);

           $num_elementos=0;
           $flag=true;

           while ($num_elementos < count($idproducto))
           {
               $sql_detalle= "INSERT INTO detalle_p(idruta, idproducto, cantidad)
               VALUES('$idrutanew', '$idproducto[$num_elementos]', '$cantidad[$num_elementos]')";
               ejecutarConsulta($sql_detalle) or $flag=false;
   
               $num_elementos=$num_elementos + 1;
           }
           return $flag;

        }

        //Funcion para activar y desactivar zona
        public function anular($idruta)
        {
            $sql = "UPDATE ruta SET estatus='Anulado'  WHERE idruta='$idruta'";
            return ejecutarConsulta($sql);
        }

       

        //funcion para mostrar informacion
        public function mostrarr($idruta)
        {
            $sql = "SELECT r.idruta,DATE(r.fecha) as fecha, r.idzona, z.nombrezona
            as zona, u.idusuario, u.nombre as usuario, r.costoruta, r.estatus  FROM ruta r INNER JOIN  usuario u ON 
            r.idusuario=u.idusuario INNER JOIN zona z ON r.idzona=z.idzona WHERE idruta='$idruta'";
            return consultarFila($sql);
        }

        //funcion para listar productos
        public function listarr()
        {
            $sql = "SELECT r.idruta,DATE(r.fecha) as fecha, r.idzona, z.nombrezona
            as zona, u.idusuario, u.nombre as usuario, r.costoruta, r.estatus  FROM ruta r INNER JOIN  usuario u ON 
            r.idusuario=u.idusuario INNER JOIN zona z ON r.idzona=z.idzona";
            return ejecutarConsulta($sql);
        }

        //funcion para listar los productos agregados a la ruta
        public function listardetalle($idruta)
        {
            $sql = "SELECT d.id_detallep, d.idproducto, p.nombre as producto, d.cantidad  FROM detalle_p d INNER JOIN
            producto p ON d.idproducto=p.idproducto WHERE idruta='$idruta'";
            return ejecutarConsulta($sql);
        }
        

    }

?>