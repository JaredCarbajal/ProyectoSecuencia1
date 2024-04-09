<?php
include 'vars.php';

# Verificar si se enviaron los parámetros requeridos
if (empty($_GET["id"])) {
    http_response_code(400);
    exit("Falta el ID"); # Terminar el script definitivamente
}

if (empty($_GET["nombre"])) {
    http_response_code(400);
    exit("Falta el nombre"); # Terminar el script definitivamente
}

if (empty($_GET["tipo"])) {
    http_response_code(400);
    exit("Falta el tipo"); # Terminar el script definitivamente
}

if (empty($_GET["stock"])) {
    http_response_code(400);
    exit("Falta el stock"); # Terminar el script definitivamente
}

if (empty($_GET["stockmax"])) {
    http_response_code(400);
    exit("Falta el stock máximo"); # Terminar el script definitivamente
}

# Crear una nueva conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Crear un arreglo con los datos del formulario
$producto = [
    "id" => $_GET["id"],
    "nombre" => $_GET["nombre"],
    "tipo" => $_GET["tipo"],
    "stock" => $_GET["stock"],
    "stockmax" => $_GET["stockmax"]
];

try {
    # Preparar la consulta para insertar los datos del producto
    $sentencia = $conex->prepare("INSERT INTO productos(id, nombre, tipo, stock, stockmax) VALUES (:id, :nombre, :tipo, :stock, :stockmax);");
    
    # Ejecutar la consulta con los valores del producto
    $resultado = $sentencia->execute($producto);

    # Si se insertaron los datos correctamente, responder con un mensaje de éxito
    if ($resultado) {
        http_response_code(200);
        echo "Datos insertados correctamente";
    } else {
        # Si hubo algún error al insertar los datos, responder con un mensaje de error
        http_response_code(400);
        echo "Error al insertar los datos";
    }
} catch(PDOException $exc) {
    # Si hubo una excepción, responder con un mensaje de error
    http_response_code(400);
    echo "Lo siento, ocurrió un error: " . $exc->getMessage();
}

# Cerrar la conexión a la base de datos
$conex = null;
?>