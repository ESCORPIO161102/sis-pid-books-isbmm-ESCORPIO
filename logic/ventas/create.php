<?php
if ($_POST) {
    require_once "../conexion.php";
    if (!isset($_POST["txtFecha"])) {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No se permite un registro de ventas sin una fecha",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
    $txtFecha = $_POST["txtFecha"];
    $txtMonto = $_POST["txtMonto"];
    $libro = $_POST["txtLibro"];
    if ($txtMonto == "") {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No se permite el registro de un campo vacio",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
    /*
 * Insert a autors
 */
    if ($conexion) {
        try {
            $sql = "INSERT INTO tb_sales (bookId,dateSale,amount) VALUES (:txtLibro,:txtFecha,:txtMonto);";
            $fecha = $txtFecha;
            $monto = $txtMonto;
            $libro = $libro;
            $prepared = $conexion->prepare($sql);
            $prepared->bindParam(':txtFecha', $fecha);
            $prepared->bindParam(':txtMonto', $monto);
            $prepared->bindParam(':txtLibro', $libro);
            $excute = $prepared->execute();
            if ($excute) {
                $result = array(
                    "status" => true,
                    "title" => "Satisfactorio",
                    "text" => "Se registro de manera correcta el registro",
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
