<?php

spl_autoload_register(function($nombre_clase){
    include "clases/" . $nombre_clase . ".php";
});


$VIDEOCLUB =  new Videoclub();

if(empty($_GET)){
    $VIDEOCLUB->mostrarPeliculas();
}else if(isset($_GET['id_pelicula'])){

    $id_pelicula = $_GET['id_pelicula'];
    $VIDEOCLUB->mostrarInformacionPelicula($id_pelicula);
}else if(isset($_GET['id_actor'])){
    $id_actor =  $_GET['id_actor'];
    $VIDEOCLUB->mostrarInformacionActor($id_actor);

}







?>