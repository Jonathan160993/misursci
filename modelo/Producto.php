<?php
    require "../configuracion/conexion.php";


    class Producto{

        //se define el constructor
        public function __cosntruct()
        {

        }

        //funcion para insertar datos en producto
        //aqui se genera el alta de los productos
        public function insertarp($nombre, $precio, $existencia)
        {
            $sql = "INSERT INTO producto(nombre, precio, existencia)
                    values ('$nombre','$precio','$existencia')";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }


        //funcion para modificaciones 
        //este metodo es para modificar la infromacion de los productos
        public function modificarp($idproducto, $nombre, $precio, $cantidad)
        {
            $sql = "UPDATE producto SET nombre='$nombre', precio='$precio', 
                    existencia='$cantidad' WHERE idproducto='$idproducto'";
            return ejecutarConsulta($sql);//se llama al metodo de conexion
        }

        //Funcion para activar y desactivar producto
        public function desactivarp($idproducto)
        {
            $sql = "UPDATE producto SET estado='0'  WHERE idproducto='$idproducto'";
            return ejecutarConsulta($sql);
        }

        //Funcion para activar producto
        public function activarp($idproducto)
        {
            $sql = "UPDATE producto SET estado='1'  WHERE idproducto='$idproducto'";
            return ejecutarConsulta($sql);
        }

        //funcion para mostrar informacion
        public function mostrarp($idproducto)
        {
            $sql = "SELECT * FROM producto WHERE idproducto='$idproducto'";
            return consultarFila($sql);
        }

        //funcion para listar preductos
        public function listarp()
        {
            $sql = "SELECT * FROM producto";
            return ejecutarConsulta($sql);
        }

        public function listarpactivo()
        {
            $sql = "SELECT * FROM producto WHERE estado='1'";
            return ejecutarConsulta($sql);
        }


    }

?>