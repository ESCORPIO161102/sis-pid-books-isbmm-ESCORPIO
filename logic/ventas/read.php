<?php
require_once("../conexion.php");
/*
*select a autors
*/
if ($conexion) {
    try {
        $sql = "SELECT*FROM tb_sales;";
        $prepared = $conexion->prepare($sql);
        $prepared->execute();
        $result = $prepared->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["data" => $result, "status" => true]);
    } catch (PDOException $errors) {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "Ah sucedido un error : " . $errors->getMessage() . "!",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
}
