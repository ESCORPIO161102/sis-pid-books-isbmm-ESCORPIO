<?php
if($_POST){

require_once "../conexion.php";
if (!isset($_POST["txtMonto"])) {
    $result = array(
        "status" => false,
        "title" => "Ocurrio un error inesperado",
        "text" => "No has seleccionado una cantidad",
        "date" => date("Y-m-d H:i:s"),
        "type" => "danger"
    );
    echo json_encode($result);
    die();
}
$txtVenta=$_POST["txtVenta"];
$txtFecha = $_POST["txtFecha"];
$txtMonto = $_POST["txtMonto"];
$libro = $_POST["txtLibro"];
if ($txtFecha == "") {
    $result = array(
        "status" => false,
        "title" => "Ocurrio un error inesperado",
        "text" => "No se permite el ingreso de un campo sin una fecha",
        "date" => date("Y-m-d H:i:s"),
        "type" => "danger"
    );
    echo json_encode($result);
    die();
}


/*
 *Update a autors 
 */
if ($conexion) {
    try {
        $sql = "UPDATE tb_sales SET dateSale=:txtFecha, amount=:txtMonto, bookId=:txtBook WHERE saleId=:txtVenta;";
        $fecha = $txtFecha;
        $monto = $txtMonto;
        $libro = $libro;
        $venta = $txtVenta;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtFecha", $fecha);
        $prepared->bindParam(":txtMonto", $monto);
        $prepared->bindParam(":txtBook", $libro);
        $prepared->bindParam(":txtVenta", $venta);
        $excute = $prepared->execute();
        if ($excute) {
            $result = array(
                "status" => true,
                "title" => "Satisfactorio",
                "text" => "Se actualizó de manera correcta el registro",
                "date" => date("Y-m-d H:i:s"),
                "type" => "success"
            );
            echo json_encode($result);
            die();
        }
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
}