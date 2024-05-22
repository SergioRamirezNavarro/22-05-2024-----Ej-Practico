<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Libro</title>
</head>

<body>
    <header>
        <h2>Biblio APP</h2>
        <button onclick="window.location.href='index.php'">index.php</button>
    </header>
    <h2>Añadir Libro</h2>
    <form action="add_book.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="fechapublicacion">Fecha de Publicación:</label>
        <input type="date" id="fechapublicacion" name="fechapublicacion"><br><br>

        <label for="idautor">ID del Autor:</label>
        <input type="number" id="idautor" name="idautor"><br><br>

        <input type="submit" value="Añadir Libro">
    </form>

    <?php
    // Procesar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Obtener los datos del formulario
        $titulo = $_POST["titulo"];
        $fechapublicacion = $_POST["fechapublicacion"];
        $idautor = $_POST["idautor"];

        // Insertar el nuevo libro en la base de datos
        $sql = "INSERT INTO libros (titulo, fechapublicacion, idautor) VALUES ('$titulo', '$fechapublicacion', '$idautor')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>¡Libro añadido correctamente!</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Cerrar la conexión
        $conn->close();
    }
    ?>
</body>

</html>
