<?php
require_once "model/conexion.php"; 
require_once "template/header.php"; 

$consulta = $bd->query("SELECT * FROM mascota ");
$mascotas = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<header>
    <nav>
        <ul></br>
            <form action="buscar.php" method="GET" >
                <button type="submit" class="btn btn-sm btn-muted" ><i class="bi bi-search"></i> Buscar</button>
            </form>
        </ul>
    </nav>
</header>
<style>
    body {
        background-image: url("img/fondodog.jpg");
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
    <div class="container my-5">
        <h1 class="text-center">BIENVENIDOS</h1>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Raza</th>
                            <th scope="col">Vacunas</th>
                            <th scope="col">Estilista</th>
                            <th scope="col">Tipo de servicio</th>
                            <th scope="col">Fecha de atención</th>
                            <th scope="col">Celular Dueño</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mascotas as $dato): ?>
                            <tr>
                                <th scope="row"><?php echo $dato['id']; ?></th>
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><?php echo $dato['raza']; ?></td>
                                <td><?php echo $dato['vacunas']; ?></td>
                                <td><?php echo $dato['estilista']; ?></td>
                                <td><?php echo $dato['tipo_de_servicio']; ?></td>
                                <td><?php echo $dato['fecha_atencion']; ?></td>
                                <td><?php echo $dato['celular']; ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo $dato['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i> Editar</a>
                                    <a href="eliminar.php?id=<?php echo $dato['id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Eliminar</a>
                                    <a class="btn btn-sm btn-info" href="agregarPromocion.php?id=<?php echo $dato['id']; ?>"><i class="bi bi-send"></i> Mensaje</a></td>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-end">
                    <a href="registrar.php" class="btn btn-success"><i class="bi bi-plus"></i> Registrar nueva mascota</a>
                </div>
            </div>
        </div>
    </div>
<?php require_once "template/footer.php"; // Incluimos el archivo del pie de página ?>