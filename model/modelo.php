<?php
include('../controller/Api.php');
#PROBANDO CONEXION A LA DB
try{
    $base = new PDO("mysql:host=localhost; dbname=prueba_tecnica","root","");
    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
}catch(Exception $e){
    echo "linea de error: ".$e->getLine()." ".$e->getMessage();
}

class consultas{
    function guardarPelicula($data){
        try{
            $base = new PDO("mysql:host=localhost; dbname=prueba_tecnica","root","");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql ="INSERT INTO `peliculas`(name,genders,language,title,resume) VALUES(:name,:genders,:language,:title,:resume)";
            $resultado = $base->prepare($sql);  
            $resultado->bindParam(':name', $data[0], PDO::PARAM_STR);
            $resultado->bindParam(':genders', $data[1], PDO::PARAM_STR);
            $resultado->bindParam(':language', $data[2], PDO::PARAM_STR);
            $resultado->bindParam(':title', $data[3], PDO::PARAM_STR);
            $resultado->bindParam(':resume', $data[4], PDO::PARAM_STR);

            $resultado->execute();
            return 1;
        }catch(Exception $e){
            echo "linea de error: ".$e->getLine()." ".$e->getMessage();
            return $e;
        }
    }
    function consultarPeliculas(){
        try{
            $base = new PDO("mysql:host=localhost; dbname=prueba_tecnica","root","");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql ="SELECT * FROM `peliculas`";
            $resultado = $base->prepare($sql);
            $resultado->execute();
            return $resultado = $resultado -> fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            echo "linea de error: ".$e->getLine()." ".$e->getMessage();
            return $e;
        }
    }
    function consultarPelicula($name){
        try{
            $base = new PDO("mysql:host=localhost; dbname=prueba_tecnica","root","");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET utf8");
            $sql ="SELECT * FROM `peliculas` WHERE `name` = '$name'";
            $resultado = $base->prepare($sql);
            $resultado->execute();
            return 1;
        }catch(Exception $e){
            echo "linea de error: ".$e->getLine()." ".$e->getMessage();
            return $e;
        }
    }
    function getData(){
        $data = [];
        $api = new Api;
        $respuesta = $api->consumingApi();
        $nombre = $respuesta->title;
        $data[0] = $nombre;
        $lista = '';
        $lista2 = [];
        $i = 0;
        foreach($respuesta->genres as $resultados){
            $lista2[$i] = $resultados->name; 
            $i++;
        }
        $i = 1;
        foreach($respuesta->genres as $resultados){
            if($i < count($lista2)){
                $lista = $lista . $resultados->name . ', ';
                $i++;
            }else{
                $lista = $lista . $resultados->name;
            }
        }
        $data[1] = $lista;
        $lenguaje = $respuesta->original_language;
        $data[2] = $lenguaje;
        $original_title = $respuesta->original_title;
        $data[3] = $original_title;
        $resume = $respuesta->overview;
        $data[4] = $resume;
        return $data;
    }
}
?>