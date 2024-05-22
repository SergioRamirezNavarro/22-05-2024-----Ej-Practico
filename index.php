<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblio APP</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>BIBLIO APP</h1>
    <hr>
    <h2>Lista de Libros</h2>
    <table>
        <tr>
            <th>Título del Libro</th>
            <th>Fecha de Publicación</th>
            <th>Autor</th>
            <th>Operaciones</th>
        </tr>

        <?php
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

        // Consulta SQL para obtener la lista de libros con sus autores
        $sql = "SELECT libros.idlibro, libros.titulo, libros.fechapublicacion, autores.nombre 
                FROM libros 
                INNER JOIN autores ON libros.idautor = autores.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["titulo"] . "</td>";
                echo "<td>" . $row["fechapublicacion"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td style='display:flex'>
                    <form action='edit_book.php' method='get'><input type='hidden' name='id' value='" . $row["idlibro"] . "'><button type='submit'>Editar</button></form>
                    <form action='delete_book.php' method='post'><input type='hidden' name='id' value='" . $row["idlibro"] . "'><button type='submit'>Eliminar</button></form></td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron libros</td></tr>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </table>

    <hr>
    <h2>Lista de Autores</h2>
    <table>
        <tr>
            <th>Nombre del Autor</th>
            <th>País</th>
            <th>Operaciones</th>
        </tr>

        <?php
        // Conectar a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener la lista de autores
        $sql = "SELECT * FROM autores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["pais"] . "</td>";
                echo "<td style='display:flex'>
                    <form action='edit_author.php' method='get'><input type='hidden' name='id' value='" . $row["id"] . "'><button type='submit'>Editar</button></form>
                    <form action='delete_author.php' method='post'><input type='hidden' name='id' value='" . $row["id"] . "'><button type='submit'>Eliminar</button></form>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron autores</td></tr>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </table>

    <hr>
    <button onclick="window.location.href='add_author.php'">Agregar Autor</button>
    <button onclick="window.location.href='add_book.php'">Agregar Libro</button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
