<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
</head>

<body>
    <header>
        <h2>Biblio APP</h2>
        <button onclick="window.location.href='index.php'">index.php</button>
    </header>

    <?php
    // Verificar si se ha proporcionado un ID de autor
    if(isset($_GET["id"])) {
        $id = $_GET["id"];

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

        // Consulta SQL para obtener los datos del autor
        $sql = "SELECT * FROM autores WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <h2>Editar Autor</h2>
            <form action="update_author.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required><br><br>

                <label for="pais">País:</label>
                <input type="text" id="pais" name="pais" value="<?php echo $row['pais']; ?>"><br><br>

                <input type="submit" value="Actualizar Autor">
            </form>
    <?php
        } else {
            echo "No se encontró el autor.";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Se requiere un ID de autor.";
        echo '<form action="edit_author.php" method="get">';
        echo '<label for="idautor">ID del Autor:</label>';
        echo '<input type="number" id="idautor" name="id" required><br><br>';
        echo '<input type="submit" value="Editar Autor">';
        echo '</form>';
    }
    ?>
</body>

</html>
