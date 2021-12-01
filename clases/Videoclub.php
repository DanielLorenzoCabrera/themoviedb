<?php

/*
    ENLACE PARA CONSULTAR INFORMACION DE UNA PELICULA
    https://api.themoviedb.org/3/movie/512195?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=es

    cURL -< Client URL
    curl_init() -> Inicializa una nueva sesión y devuelve un objecto cURL handle para usar en las funciones curl_setopt(), curl_exec(), and curl_close().
    curl_setopt($handle,int $option, value) -> Establece las opciones de la conexion curl (int son variables ya creadas en php)
    curl_exec(CurlHandle $handle): string|bool -> ejecuta una sesion curl
    curl_close() -> finaliza una sesion curl

    CURLOPT_URL	(No es necesaria si se ha inicializado con curl_init())
        The URL to fetch. This can also be set when initializing a session with curl_init().

    CURLOPT_RETURNTRANSFER (Devuelve el resultado como string en lugar de mostrarlo directamente)
        true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

*/

    class Videoclub{
        private $api_key = "0bd8a8eb5c3993fd33872f75979674ff";
        private $url;
        private $resultados;
        private $curlHandle;


        public function __construct(){

            $this->url = "https://api.themoviedb.org/3/discover/movie?api_key={$this->api_key}&language=es";
            $this->curlHandle = curl_init($this->url); 
            curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
            $datos = json_decode(curl_exec($this->curlHandle), true);
            $this->resultados = $datos["results"];
        }


        public function mostrarPeliculas(){
            foreach($this->resultados as $pelicula){
                echo "<div class='film'>";
                echo "<a href='index.php?id={$pelicula['id']}'>";
                echo "<img src='https://image.tmdb.org/t/p/w185{$pelicula['poster_path']}'>";
                echo "</a>";
                echo "<p>{$pelicula["original_title"]}</p>";
                echo "</div>";
            }
        }

        public function mostrarInformacionPelicula($id_pelicula){
            $url_pelicula = "https://api.themoviedb.org/3/movie/{$id_pelicula}?api_key={$this->api_key}&language=es";
            $url_actores = "https://api.themoviedb.org/3/movie/{$id_pelicula}/credits?api_key={$this->api_key}&language=en-US";
            $datos = $this->hacerPeticion($url_pelicula);
            $actores = $this->hacerPeticion($url_actores);
            echo "<div class='film-info'>";
            echo "<figure><img src='https://image.tmdb.org/t/p/w185{$datos['poster_path']}'></figure>";
            echo "<h2>{$datos['original_title']}</h2>";
            echo "<p class='descripcion'>{$datos['overview']}</p>";
            echo "<article class='generos'>";
            $this->mostrarElementos($datos['genres'],"name");
            echo "</article>";
            echo "<article class='actores'>";
            $this->mostrarElementos($actores['cast'],"name");
            echo "</article>";
            echo "</div>";

        
            

/*
            echo "<div class='film-info'>";
            echo "<img src='https://image.tmdb.org/t/p/w185{$pelicula['poster_path']}'>";
            echo "</a>";
            echo "<p>{$pelicula["original_title"]}</p>";
            echo "</div>";
        }


*/


    }

    public function getApiKey(){
        return $this->api_key;
    }

    private function mostrarElementos($array,$key){
        foreach($array as $element){
            echo "<p>{$element[$key]}</p>";
        }
    }


    private function hacerPeticion($url){
        $peticion = curl_init($url);
        curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
        $datos = json_decode(curl_exec($peticion), true);
        curl_close($peticion);
        return $datos;
    }


    }

    //$url_peliculas = "https://api.themoviedb.org/3/discover/movie?api_key=1865f43a0549ca50d341dd9ab8b29f49&language=es";
    //$videoclub = new Videoclub($url_peliculas);

    //$videoclub->mostrarPeliculas();
/*
    foreach($videoclub->resultados as $clave => $resultado){
        echo "<div>";
        echo "<img src='https://image.tmdb.org/t/p/w185{$resultado['poster_path']}'>";
        echo "<p>{$resultado['original_title']}</p>";
        echo "</div>";
    }

*/







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