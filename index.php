<?php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurar conexión a la base de datos MySQL PaaS
$host = "mi-bd-formulario.mysql.database.azure.com"; 
$usuario = "adminuser@mi-bd-formulario";              
$contrasena = "Flower0311";                
$bd = "mi-bd-formulario";                                

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Procesar formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];

    $sql = "INSERT INTO usuarios (nombre, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $email);
    
    if ($stmt->execute()) {
        echo "<p>Datos guardados correctamente.</p>";
    } else {
        echo "<p>Error al guardar: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Mostrar formulario
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Contacto</title>
</head>
<body>
    <h1>Formulario de Contacto</h1>
    <form method="post">
        Nombre: <input type="text" name="nombre" required><br>
        Email: <input type="email" name="email" required><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
