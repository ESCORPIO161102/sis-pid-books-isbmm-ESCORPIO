<?php

/*
insert a autors
*/
if ($conexion) {
    try{
    
        $sql = "INSERT INTO tb_autors (a_name,a_nacionalidad)VALUES (:txtName,:txtNacionalidad)";
        $name="Jhon";
        $nacionalidad="Rodriguez";
        $prepared = $conexion->prepare(query: $sql);
        $prepared->bindParam(':txtName',$name);
        $prepared->bindParam(':txtNacionalidad',$nacionalidad);
        $execute = $prepared->execute();
        if ($execute) {
            echo "Registro completado";
        } 

    }catch (PDOException $errors) {
        echo "ha suscedido un eror". $errors->getMessage() . "";
    }
}

    /*
select a autors
*/
if ($conexion) {
    try {
        $sql = "SELECT*FROM tb_autors;";
        $prepared = $conexion->prepare($sql);
        $prepared->execute();
        $result = $prepared->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}

/*
update a autors
*/

if ($conexion) {
    try{
    $sql= "UPDATE tb_autors SET a_name=:txtName, a_nacionalidad=:txtNacionalidad where autorid=:txtAutorId;";
    $name ="jhon";
    $nacionalidad= "Russo";
    $AutorId=3;
    $prepared = $conexion->prepare(query: $sql);
    $prepared->bindParam(":txtName",$name);
    $prepared->bindParam(":txtNacionalidad",$nacionalidad);
    $prepared->bindParam(":txtAutorId",$AutorId);
    $execute = $prepared->execute();
    if ($execute) {
        echo ("Registro Actualizado");
    }
}catch (PDOException $errors) {
    echo " ha suscedido un eror". $errors->getMessage() . "";
}
}


/*
delete a autors
*/
if ($conexion) {
    try {
        $sql = "DELETE FROM tb_autors WHERE autorId=:txtAutorId;";
        $AutorId= 10;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtAutorId",$AutorId);
        $execute = $prepared->execute();
        if ($execute) {
            echo (" Registro Eliminado");
        }

    } catch (PDOException $errors) {
        echo "ha sucedido un erorr". $errors->getMessage() . "";
    }
}

