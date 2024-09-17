<?php
/*
 *Variables de administracion 
 */
$server = "localhost";
$user = "root";
$password = "";
$bd = "db_storeBooks";
$charset = "utf8";
$host = "mysql:host=$server;dbname=$bd;charset=$charset";
try {
    //creamos la conexion a la bd
    $conexion = new PDO($host, $user, $password);
    //Se establece el modo de errores a excepcion
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Forzamos el uso de consultas con UTF8
    $conexion->exec("SET NAMES 'utf8'");
    $status = true ;

} catch (PDOException $errors) {
    $status = false ;
     
    $result = array(
        "status"=> false,
        "title"=> "Ocurrio un error inesperado",
        "text" => "Ah sucedido un error : " . $errors->getMessage() . "!",
        "date"=> date("Y-m-d H:i:s"),
        "type" => "danger"

);
echo json_encode($result);
die();


}