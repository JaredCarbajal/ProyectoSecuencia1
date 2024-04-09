<?php 
header("Content-Type: text/html;charset=utf-8");

if(! empty($_GET)){
    $id=(isset($_GET["id"])?$_GET["id"]:"");
    $nombre=(isset($_GET["nombre"])?$_GET["nombre"]:"");
    $tipo=(isset($_GET["tipo"])?$_GET["tipo"]:"");
    $stock=(isset($_GET["stock"])?$_GET["stock"]:"No se recibio stock");
    $stockmax=(isset($_GET["stockmax"])?$_GET["stockmax"]:"");
    http_response_code(200);
    echo $id.",".$nombre.",".$tipo.",".$stock.",".$stockmax;
}else{
    http_response_code(400);
    echo "sin datos recibidos";
}
exit();
?>