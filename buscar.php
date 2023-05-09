<style>
    body {
        background-image: url("img/perritos.jpg");
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<?php
require_once "model/conexion.php"; // Incluimos el archivo de conexión a la base de datos
require_once "template/header.php"; // Incluimos el archivo del encabezado

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos el valor enviado por el formulario
    $busqueda = trim($_POST["busqueda"]);

    // Preparamos la consulta SQL para buscar mascotas que coincidan con la búsqueda del usuario
    $stmt = $bd->prepare("SELECT * FROM mascota WHERE nombre LIKE :busqueda OR raza LIKE :busqueda OR estilista LIKE :busqueda OR tipo_de_servicio LIKE :busqueda OR fecha_atencion LIKE :busqueda OR celular LIKE :busqueda");
    $busqueda = "%" . $busqueda . "%"; // Agregamos comodines a la búsqueda
    $stmt->bindParam(":busqueda", $busqueda);
    $stmt->execute();
    $mascotas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<div class="container">
    <h1>Buscar mascota</h1>
    <form method="post">
        <div class="form-group">
            <label for="busqueda">Ingrese el nombre, raza de su perro, estilista, tipo de servicio o fecha de atención de la mascota que desea buscar:</label>
            <input type="text" id="busqueda" name="busqueda" class="form-control" value="<?php echo isset($_POST["busqueda"]) ? $_POST["busqueda"] : "" ?>">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php if (isset($mascotas)): ?>
        <h2>Resultados de búsqueda</h2>
        <?php if (count($mascotas) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Raza de su perro</th>
                        <th>Vacunas</th>
                        <th>Estilista</th>
                        <th>Tipo de servicio</th>
                        <th>Fecha de atención</th>
                        <th>Celular Dueño</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mascotas as $mascota): ?>
                        <tr>
                            <td><?php echo $mascota["nombre"] ?></td>
                            <td><?php echo $mascota["raza"] ?></td>
                            <td><?php echo $mascota["vacunas"] ?></td>
                            <td><?php echo $mascota["estilista"] ?></td>
                            <td><?php echo $mascota["tipo_de_servicio"] ?></td>
                            <td><?php echo $mascota["fecha_atencion"] ?></td>
                            <td><?php echo $mascota["celular"] ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $mascota["id"] ?>" class="btn btn-warning">Editar</a>
                                <a href="eliminar.php?id=<?php echo $mascota["id"] ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron mascotas que coincidan con la búsqueda.</p>
        <?php endif ?>
    <?php endif ?>

</div>
<?php require_once "template/footer.php"; ?>