<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daniel Lorenzo">
    <meta name="keywords" content="PHP PELICULAS moviedb">
    <title>Todopelis.org</title>
    <link rel="stylesheet" href="estilos.css">
    
</head>
<body>
    <header><a href="index.php">TodoPelis</a></header>
    <nav>
        <form action="<?= $_SERVER['PHP_SELF']?>" method="GET">

        <p> 
            <label for="request">Nombre</label>
            <input type="text" name="request" id="request" required>
        </p>
        <p> 
            <label for="year">Año</label>
            <input type="number" name="year" id="year"  min='1990' max='2021'>
        </p>
        <p> 
            <label>+18</label>
            <select name="adulto" id="">
                <option value="true">Si</option>
                <option value="false">No</option>
            </select>
        </p>
        <input type="submit" value="enviar" name="send-request">

    
    
    
    
        </form>
    </nav>
    <main>
        <?php include_once 'controlador.php';?>



    </main>
    
</body>
</html>