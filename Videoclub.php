<?php

/*
    cURL -< Client URL
    curl_init() -> Inicializa una nueva sesión y devuelve un objecto cURL handle para usar en las funciones curl_setopt(), curl_exec(), and curl_close().
    curl_setopt($handle,int $option, value) -> Establece las opciones de la conexion curl (int son variables ya creadas en php)
    curl_exec(CurlHandle $handle): string|bool -> ejecuta una sesion curl
    curl_close() -> finaliza una sesion curl

    CURLOPT_URL	
        The URL to fetch. This can also be set when initializing a session with curl_init().

    CURLOPT_RETURNTRANSFER	
        true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

*/

    class Videoclub{
        private $api_key;
        private $url;
        public $resultados;
        private $curlHandle;


        public function __construct($url){
            $this->url = $url;
            $this->curlHandle = curl_init($url); 
            //curl_setopt($this->curlHandle, CURLOPT_URL, $url);
            curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
            $datos = json_decode(curl_exec($this->curlHandle), true);
            $this->resultados = $datos["results"];

        }

    }

    $url_peliculas = "https://api.themoviedb.org/3/discover/movie?api_key=1865f43a0549ca50d341dd9ab8b29f49&language=es";
    $videoclub = new Videoclub($url_peliculas);

    foreach($videoclub->resultados as $clave => $resultado){
        echo "<div>";
        echo "<img src='https://image.tmdb.org/t/p/w185{$resultado['poster_path']}'>";ñ
        echo "<p>{$resultado['original_title']}</p>";
        echo "</div>";
    }









    /*


    // create curl resource
    $ch = curl_init();

//   
    $url="https://api.themoviedb.org/3/discover/movie?api_key=1865f43a0549ca50d341dd9ab8b29f49&language=es";

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $peliculas = curl_exec($ch);

    //echo $peliculas;

    $datos = json_decode($peliculas, true);

    $result = $datos["results"];

    foreach ($result as $pelicula) {
        echo "<div>";
        echo '<img src="https://image.tmdb.org/t/p/w185';
        echo $pelicula["backdrop_path"];
        echo '" alt="">';
        echo $pelicula["title"];
        echo "</div>";
    }

    // close curl resource to free up system resources
    curl_close($ch);










    $ch = curl_init();

    $url = "https://api.themoviedb.org/3/discover/movie?api_key=1865f43a0549ca50d341dd9ab8b29f49&language=es";

    // set url

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($ch);

    $datos = json_decode($output, true);

    var_dump($output);

    curl_close($ch);

*/




?>