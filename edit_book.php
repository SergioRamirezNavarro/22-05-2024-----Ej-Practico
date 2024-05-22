<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
</head>

<body>
    <header>
        <h2>Biblio APP</h2>
        <button onclick="window.location.href='index.php'">index.php</button>
</header>

    <?php
    // Verificar si se ha proporcionado un ID de libro
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

        // Consulta SQL para obtener los datos del libro
        $sql = "SELECT * FROM libros WHERE idlibro = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <h2>Editar Libro</h2>
            <form action="update_book.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $row['titulo']; ?>" required><br><br>

                <label for="fechapublicacion">Fecha de Publicación:</label>
                <input type="date" id="fechapublicacion" name="fechapublicacion" value="<?php echo $row['fechapublicacion']; ?>"><br><br>

                <label for="idautor">ID del Autor:</label>
                <input type="number" id="idautor" name="idautor" value="<?php echo $row['idautor']; ?>"><br><br>

                <input type="submit" value="Actualizar Libro">
            </form>
    <?php
        } else {
            echo "No se encontró el libro.";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Se requiere un ID de libro.";
        echo '<form action="edit_book.php" method="get">';
        echo '<label for="idlibro">ID del Libro:</label>';
        echo '<input type="number" id="idlibro" name="id" required><br><br>';
        echo '<input type="submit" value="Editar Libro">';
        echo '</form>';
    }
    ?>
</body>

</html>
