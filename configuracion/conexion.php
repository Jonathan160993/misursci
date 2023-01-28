<?php

    //accede a las propiedades de global
    require_once "global.php";

    $conexion = new mysqli(db_host, db_user, db_pw, db_nombre);

    //consulta a la base de datos

    mysqli_query($conexion, 'SET NAMES"'.db_encode.'"');

    //Validamos la conexion a la base de datos
    if(mysqli_connect_errno())
    {
        printf("Fallo la conexio a la base de datos: %s\n"
        ,mysqli_connect_errno());
        exit();
    }

    if(!function_exists('ejecutarConsulta'))
    {
        //generamos una consulta
        function ejecutarConsulta($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $query;
        }

        //consulta fila de la db y retorna datos obtenidos
        function consultarFila($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            $fila = $query->fetch_assoc();
            return $fila;
        }

        //consulta que retorna el id se implementa metodo insert_id
        function consulta_retornaid($sql)
        {
                global $conexion;
                $query = $conexion->query($sql);
                return $conexion->insert_id; 
        }

        function limpiarCadena($str)
        {
            global $conexion;
            $str = mysqli_real_escape_string($conexion,trim($str));
            return htmlspecialchars($str);

        }


    }



?>