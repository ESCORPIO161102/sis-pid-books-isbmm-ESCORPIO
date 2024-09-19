<?php

if ($_POST) {

    

    require_once "../conexion.php";
    if (!isset($_POST["sltNacionalidad"])) {
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
    $txtName = $_POST["txtName"];
    $sltNacionalidad = $_POST["sltNacionalidad"];
    if ($txtName == "") {
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
 * Insert a autors
 */
    if ($conexion) {
        try {
            $sql = "INSERT INTO tb_autors (a_name,a_nacionalidad) VALUES (:txtName,:txtNacionalidad);";
            $name = $txtName;
            $nacionalidad = $sltNacionalidad;
            $prepared = $conexion->prepare($sql);
            $prepared->bindParam(':txtName', $name);
            $prepared->bindParam(':txtNacionalidad', $nacionalidad);
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
