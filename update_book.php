<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
</head>
<body>
    <header>
        <h2>Biblio APP</h2>
        <button onclick="window.location.href='index.php'">index.php</button>
</header>

    <?php
    // Verificar si se han enviado datos mediante POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $id = $_POST["id"];
        $titulo = $_POST["titulo"];
        $fechapublicacion = $_POST["fechapublicacion"];
        $idautor = $_POST["idautor"];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "biblio";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para actualizar el libro
        $sql = "UPDATE libros SET titulo='$titulo', fechapublicacion='$fechapublicacion', idautor='$idautor' WHERE idlibro='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Libro actualizado correctamente.";
        } else {
            echo "Error al actualizar el libro: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "No se han recibido datos mediante POST.";
    }
    ?>

    <br><br>
    
</body>
</html>
