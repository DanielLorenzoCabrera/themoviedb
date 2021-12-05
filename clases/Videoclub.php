<?php

/*
    ENLACE PARA CONSULTAR INFORMACION DE UNA PELICULA
    https://api.themoviedb.org/3/movie/512195?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=es

    cURL -< Client URL
    curl_init($url) -> Inicializa una nueva sesión y devuelve un objecto cURL handle para usar en las funciones curl_setopt(), curl_exec(), and curl_close().
    curl_setopt($handle,int $option, value) -> Establece las opciones de la conexion curl (int son variables ya creadas en php)
    curl_exec(CurlHandle $handle): string|bool -> ejecuta una sesion curl
    curl_close() -> finaliza una sesion curl

    CURLOPT_URL	(No es necesaria si se ha inicializado con curl_init())
        The URL to fetch. This can also be set when initializing a session with curl_init().

    CURLOPT_RETURNTRANSFER (Devuelve el resultado como string en lugar de mostrarlo directamente)
        true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.

*/


// RESOURCES 

// ACTORES : https://api.themoviedb.org/3/movie/580489/credits?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=en-US
// INFORMACION PELI https://api.themoviedb.org/3/movie/580489?api_key=0bd8a8eb5c3993fd33872f75979674ff&language=es"
// RUTA IMAGENES https://image.tmdb.org/t/p/w185{RUTA}


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
                echo "<a href='index.php?id_pelicula={$pelicula['id']}'>";
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
            $this->mostrarGeneros($datos['genres'],"name");
            echo "</article>";
            echo "<article class='actores'>";
            $this->mostrarActores($actores['cast']);
            echo "</article>";
            echo "</div>";
    }


    public function mostrarInformacionActor($id_actor){
        $url_actor = "https://api.themoviedb.org/3/person/{$id_actor}?api_key={$this->api_key}&language=en-US";
        $datos_actor = $this->hacerPeticion($url_actor);
        echo "<article class='actor-info'>";
        echo "<figure><img src='https://image.tmdb.org/t/p/w185{$datos_actor['profile_path']}'></figure>";
        echo "<section>";
        echo "<p>Nombre : {$datos_actor['name']}</p>";
        echo "<p>Desempeño : {$datos_actor['known_for_department']}";
        echo "<p>Fecha de nacimiento : {$datos_actor['birthday']}";
        echo "<p>Lugar de nacimiento : {$datos_actor['place_of_birth']}";
        echo "</section>";
        echo "</article>";
    }





    private function mostrarGeneros($array,$key){
        foreach($array as $element){
            echo "<p>{$element[$key]}</p>";
        }
    }


    private function mostrarActores($actores){
        foreach($actores as $actor){
            echo "<div class='actor'>";
            echo "<a href='index.php?id_actor={$actor['id']}'>";
            echo "<img src='https://image.tmdb.org/t/p/w185{$actor['profile_path']}'>";
            echo "<p>{$actor['original_name']}</p>";
            echo "</a>";
            echo "</div>";

        }
    }


    private function hacerPeticion($url){
        $peticion = curl_init($url);
        curl_setopt($peticion, CURLOPT_RETURNTRANSFER, true);
        $datos = json_decode(curl_exec($peticion), true);
        curl_close($peticion);
        return $datos;
    }



    public function buscarPelicula($request, $year, $adult){
        $query = urlencode($request);
        $url = "https://api.themoviedb.org/3/search/movie?api_key={$this->api_key}&language=en-US&query={$query}&page=1&include_adult={$adult}";
        $datos = $this->hacerPeticion($url);
        
        $peliculas = $datos['results'];
        foreach($peliculas as $pelicula){
            echo "<div class='film'>";
            echo "<a href='index.php?id_pelicula={$pelicula['id']}'>";
            echo "<img src='https://image.tmdb.org/t/p/w185{$pelicula['poster_path']}'>";
            echo "</a>";
            echo "<p>{$pelicula["original_title"]}</p>";
            echo "</div>";
        }
        

    }


}

    
   

?>