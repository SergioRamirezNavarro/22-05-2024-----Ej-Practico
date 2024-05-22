<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
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
</head>
<body>
    <header><h2>Biblio APP - Autores</h2></header>

    <h2>Autores</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>País</th>
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

        // Consulta SQL para obtener la lista de autores
        $sql = "SELECT * FROM autores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["idautor"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["pais"] . "</td>";
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
    <button onclick="window.location.href='add_author.php'">add_author.php</button>
</body>
</html>
