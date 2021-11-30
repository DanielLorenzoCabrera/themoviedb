<?php

spl_autoload_register(function($nombre_clase){
    include "clases/" . $nombre_clase . ".php";
});

$url_peliculas = "https://api.themoviedb.org/3/discover/movie?api_key=1865f43a0549ca50d341dd9ab8b29f49&language=es";


$VIDEOCLUB =  new Videoclub($url_peliculas);


$VIDEOCLUB->mostrarPeliculas();





?>