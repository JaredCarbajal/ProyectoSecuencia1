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

if (empty($_GET["edad"])) {
    http_response_code(400);
    exit("Falta la edad"); # Terminar el script definitivamente
}
if (empty($_GET["rfc"])) {
    http_response_code(400);
    exit("Falta la rfc"); # Terminar el script definitivamente
}
if (empty($_GET["correo"])) {
    http_response_code(400);
    exit("Falta el correo"); # Terminar el script definitivamente
}



# Crear una nueva conexión a la base de datos
$conex = new PDO("sqlite:" . $nombre_fichero);
$conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Crear un arreglo con los datos del formulario
$cliente = [
    "id" => $_GET["id"],
    "nombre" => $_GET["nombre"],
    "apellido" => $_GET["apellido"],
    "domicilio" => $_GET["domicilio"],
    "edad" => $_GET["edad"],
    "rfc" => $_GET["rfc"],
    "correo" => $_GET["correo"],

    
];

try {
    # Preparar la consulta para insertar los datos del producto
    $sentencia = $conex->prepare("UPDATE Clientes SET nombre=:nombre, apellido=:apellido, domicilio=:domicilio, edad=:edad, rfc=:rfc, correo=:correo WHERE id=:id;");
    
    # Ejecutar la consulta con los valores del producto
    $resultado = $sentencia->execute($cliente);

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