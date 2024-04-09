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

if (empty($_GET["apellido"])) {
    http_response_code(400);
    exit("Falta el apellido"); # Terminar el script definitivamente
}

if (empty($_GET["domicilio"])) {
    http_response_code(400);
    exit("Falta el domicilio"); # Terminar el script definitivamente
}

if (empty($_GET["correo"])) {
    http_response_code(400);
    exit("Falta el correo"); # Terminar el script definitivamente
}

if (empty($_GET["telefono"])) {
    http_response_code(400);
    exit("Falta el telefono"); # Terminar el script definitivamente
}

if (empty($_GET["ocupacion"])) {
    http_response_code(400);
    exit("Falta la ocupacion"); # Terminar el script definitivamente
}

if (empty($_GET["edad"])) {
    http_response_code(400);
    exit("Falta la edad"); # Terminar el script definitivamente
}
# Crear una nueva conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Crear un arreglo con los datos del formulario
$empleado = [
    "id" => $_GET["id"],
    "nombre" => $_GET["nombre"],
    "apellido" => $_GET["apellido"],
    "domicilio" => $_GET["domicilio"],
    "correo" => $_GET["correo"],
    "telefono" => $_GET["telefono"],
    "edad" => $_GET["edad"]
];

try {
    # Preparar la consulta para insertar los datos del producto
    $sentencia = $conex->prepare("UPDATE Empleados SET nombre=:nombre, apellido=:apellido, domicilio=:domicilio, correo=:correo, telefono=:telefono, edad=:edad WHERE id=:id;");
    
    # Ejecutar la consulta con los valores del producto
    $resultado = $sentencia->execute($empleado);

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