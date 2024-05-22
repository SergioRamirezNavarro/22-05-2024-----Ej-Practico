<?php
// Verificar si se ha enviado un ID de autor mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Obtener el ID del autor a eliminar
    $id = $_POST["id"];

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

    // Consulta SQL para eliminar el autor y sus libros asociados
    $sql = "DELETE FROM autores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Autor eliminado correctamente.";
    } else {
        echo "Error al eliminar el autor: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "No se ha proporcionado un ID de autor válido.";
}
?>
