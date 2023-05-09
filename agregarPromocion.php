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

$id = $_GET['id'];

$sentencia = $bd->prepare("select * from mascota where id = ?;");
$sentencia->execute([$id]);
$mascotas = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_promocion = $bd->prepare("select * from promociones where id_mascota = ?;");
$sentencia_promocion->execute([$id]);
$promocion = $sentencia_promocion->fetchAll(PDO::FETCH_OBJ); 
//print_r($mascotas);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos para la Promocion del dueño(a) de: <br><?php echo $mascotas->nombre; ?>
                </div>
                <form class="p-4" method="POST" action="registrarPromocion.php">
                    <div class="mb-3">
                        <label class="form-label">Promocion: </label>
                        <input type="text" class="form-control" name="txtPromocion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duración de la Promocion: </label>
                        <input type="text" class="form-control" name="txtDuracion" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $mascotas->id; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Lista de Promociones
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Promoción</th>
                                <th scope="col">Duración</th>
                                <th scope="col" colspan="4">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($promocion as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->promocion; ?></td>
                                    <td><?php echo $dato->duracion;; ?></td>
                                    <td><a  href="enviarMensaje.php?id=<?php echo $dato->id; ?>" class="text-primary"><i class="bi bi-whatsapp"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "template/footer.php"; ?>