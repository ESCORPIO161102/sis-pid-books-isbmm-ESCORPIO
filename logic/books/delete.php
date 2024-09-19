<?php
/*
 *delete a autors
 */
if ($conexion) {
    try {
        $sql = "DELETE FROM tb_autors WHERE autorId=:txtAutorId;";
        $autorId = 8;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtAutorId", $autorId);
        $excute = $prepared->execute();
        if ($excute) {
            echo ("Registro eliminado");
        }
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}
