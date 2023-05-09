<?php
    print_r($_POST);
    if(!isset($_POST['id'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $id = $_POST['id'];
    $nombre = $_POST['txtNombres'];
    $raza = $_POST['txtRaza'];
    $vacunas = $_POST['txtVacunas'];
    $estilista = $_POST['txtEstilista'];
    $tipo_servicio = $_POST['txtTipoServicio'];
    $fecha_atencion = $_POST['txtFechaAtencion'];
    $celular = $_POST['txtCelular'];

    $sentencia = $bd->prepare("UPDATE mascota SET nombre = ?, raza = ?, vacunas = ?, tipo_servicio = ?,fecha_nacimiento = ?,celular = ? where id = ?;");
    $resultado = $sentencia->execute([$nombre, $raza, $vacunas, $estilista, $tipo_servicio, $fecha_atencion, $celular,$id]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }