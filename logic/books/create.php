<?php

if ($_POST) {

    require_once "../conexion.php";
    if (!isset($_POST["sltGender"])) {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No has seleccionado una nacionalidad",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"

        );
        echo json_encode($result);
        die();
    }
    $txtTitle= $_POST["txtTitle"];
    $sltGender = $_POST["sltGender"];
    $intPrice = $_POST["intPrice"];
    $intAutorId = $_POST[""];
    if ($txtTitle == "") {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No se el ingreso de nombre vacio" ,
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"

        );
        echo json_encode($result);
        die();
    }
/*
 * Insertar en tb_books
 */
if ($conexion) {
    try {
        $sql = "INSERT INTO tb_books (b_title, b_gender, b_price, autorId) 
                VALUES (:txtTitle, :sltGender, :intPrice, :intAutorId);";
        
        // Vinculamos los parámetros correctamente
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(':txtTitle', $txtTitle);
        $prepared->bindParam(':sltGender', $sltGender);
        $prepared->bindParam(':intPrice', $intPrice);
        $prepared->bindParam(':intAutorId', $intAutorId);
        
        
        $execute = $prepared->execute();

        if ($execute) {
            $result = array(
                "status" => true,
                "title" => "Satisfactorio",
                "text" => "Se registró de manera correcta el registro",
                "date" => date("Y-m-d H:i:s"),
                "type" => "success"
            );
            echo json_encode($result);
            die();
        }
    } catch (PDOException $errors) {
        $result = array(
            "status" => false,
            "title" => "Ocurrió un error inesperado",
            "text" => "Ha sucedido un error: " . $errors->getMessage() . "!",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
}
}