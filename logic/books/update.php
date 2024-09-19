<?php
/*
 *Update a autors 
 */
if ($conexion) {
    try {
        $sql = "UPDATE tb_autors SET a_name=:txtName, a_nacionalidad=:txtNacionalidad WHERE autorId=:txtAutorId;";
        $name = "Yeison Danner Carhuapoma Dett";
        $nacionalidad = "Peruano";
        $autorId = 4;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtName", $name);
        $prepared->bindParam(":txtNacionalidad", $nacionalidad);
        $prepared->bindParam(":txtAutorId", $autorId);
        $excute = $prepared->execute();
        if ($excute) {
            echo ("Registro atualizado");
        }
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}
