<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Autor</title>
</head>

<body>
    <header>
        <h2>Biblio APP</h2>
        <button onclick="window.location.href='index.php'">index.php</button>
    </header>
    <h2>Añadir Autor</h2>
    <form action="add_author.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais"><br><br>

        <input type="submit" value="Añadir Autor">
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
        $nombre = $_POST["nombre"];
        $pais = $_POST["pais"];

        // Insertar el nuevo autor en la base de datos
        $sql = "INSERT INTO autores (nombre, pais) VALUES ('$nombre', '$pais')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>¡Autor añadido correctamente!</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Cerrar la conexión
        $conn->close();
    }
    ?>
</body>

</html>