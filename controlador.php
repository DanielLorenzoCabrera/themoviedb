<?php

spl_autoload_register(function($nombre_clase){
    include "clases/" . $nombre_clase . ".php";
});


$VIDEOCLUB =  new Videoclub();

if(empty($_GET)){
    $VIDEOCLUB->mostrarPeliculas();
}else if(isset($_GET['id'])){

    $id_pelicula = $_GET['id'];
    $VIDEOCLUB->mostrarInformacionPelicula($id_pelicula);
}







?>