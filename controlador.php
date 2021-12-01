<?php

spl_autoload_register(function($nombre_clase){
    include "clases/" . $nombre_clase . ".php";
});

$url_peliculas = "https://api.themoviedb.org/3/discover/movie?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=es";
$VIDEOCLUB =  new Videoclub($url_peliculas);

if(empty($_GET)){
    $VIDEOCLUB->mostrarPeliculas();
}else if(isset($_GET['id'])){

    $id_pelicula = $_GET['id'];
    $url_pelicula = "https://api.themoviedb.org/3/movie/{$id_pelicula}?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=es";

    $VIDEOCLUB->mostrarInformacionPelicula($url_pelicula);
}







?>