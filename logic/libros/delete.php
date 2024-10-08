<?php
if ($_POST) {
    require_once "../conexion.php";
    $txtbook = $_POST["bookid"];

    if ($txtbook == "") {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No se permite el ingreso de campos vacios",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
    /*
 *delete a autors
 */
    if ($conexion) {
        try {
            $sql = "DELETE FROM `tb_books` WHERE  `bookId`=:txtBookId";
            $libro = $txtbook;
            $prepared = $conexion->prepare($sql);
            $prepared->bindParam(":txtBookId", $libro);
            $excute = $prepared->execute();
            if ($excute) {
                $result = array(
                    "status" => true,
                    "title" => "Correcto",
                    "text" => "Registro eliminado correctamente",
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
