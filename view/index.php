<?php
include('../model/modelo.php');
$consulta = new consultas;
$data = $consulta->getData();
$query = $consulta->consultarPeliculas();
$api = new Api;
$respuesta = $api->consumingApi();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">  
            <a  class="navbar-brand" href="index.php">INICIO</a>
        </div>
    </nav>
    <h1> <b>Bienvenido! Aqui se encuentra la pelicula mas reciente.</b> </h1>
    <form method="get">
        <div class="d-grid gap-2">
            <input class="btn btn-success" type="submit" name="pelicula" value="CLICK AUI PARA OBTENER PELICULA MAS RECIENTE">
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
          <tr class="table-success">
            <th scope="col">Nombre Pelicula</th>
            <th scope="col">Genero Pelicula</th>
            <th scope="col">Lenguaje Pelicula</th>
            <th scope="col">Titulo Original Pelicula</th>
            <th scope="col">Resumen</th>
          </tr>
        </thead>
    <?php 
        if(isset($_GET['pelicula'])){
            $guardar = $consulta->guardarPelicula($data);
            echo $guardar;
            if($guardar == 1){
                header('location: index.php');
            }else{
                echo "HUBO UN ERROR AL GUARDAR";
            }
        }
    ?>
    <?php 
        foreach($query as $pelicula){
        ?>
        <tbody>
          <tr class="table-success">
            <td><h3><?php echo $pelicula->name;?></h3></td>
            <td><h3><?php echo $pelicula->genders;?></h3></td>
            <td><h3><?php echo $pelicula->language;?></h3></td>
            <td><h3><?php echo $pelicula->title;?></h3></td>
            <td><h3><?php echo $pelicula->resume;?></h3></td>
          </tr>
        </tbody>
        <?php
        }
    ?>
    </table>
</body>
<footer class="bg-dark text-center text-white">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Desarrollado por Carlos Quesada 2022.
      </div>
</footer>
</html>