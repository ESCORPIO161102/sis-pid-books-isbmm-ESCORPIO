<?php
if($_POST){

require_once "../conexion.php";
if (!isset($_POST["txtGender"])) {
    $result = array(
        "status" => false,
        "title" => "Ocurrio un error inesperado",
        "text" => "No has seleccionado un genero",
        "date" => date("Y-m-d H:i:s"),
        "type" => "danger"
    );
    echo json_encode($result);
    die();
}
$txtbook= $_POST["bookid"];
$txtTitle = $_POST["txtTitle"];
$txtGender = $_POST["txtGender"];
$txtPrice = $_POST["txtPrice"];
$txtAutor = $_POST["txtAutor"];
if ($txtTitle == "") {
    $result = array(
        "status" => false,
        "title" => "Ocurrio un error inesperado",
        "text" => "No se permite el ingreso de nombre vacio",
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
        $sql = "UPDATE tb_books SET b_title=:txtTitle, b_gender=:txtGender, b_price=:txtPrice, autorId=:txtAutor WHERE bookId=:txtbookid;";
        $title = $txtTitle;
        $gender = $txtGender;
        $price = $txtPrice;
        $autor = $txtAutor;
        $libro = $txtbook;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtTitle", $title);
        $prepared->bindParam(":txtGender", $gender);
        $prepared->bindParam(":txtPrice", $price);
        $prepared->bindParam(":txtAutor", $autor);
        $prepared->bindParam(":txtbookid", $libro);
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