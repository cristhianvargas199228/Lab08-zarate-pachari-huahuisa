<style>
    body {
        background-image: url("img/perritoz.jpg");
        background-repeat: no-repeat;
        background-position: center center;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<?php
require_once "model/conexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $stmt = $bd->prepare("SELECT COUNT(*) FROM promociones WHERE id_mascota = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $stmt = $bd->prepare("DELETE FROM promociones WHERE id_mascota = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    $stmt = $bd->prepare("DELETE FROM mascota WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$id = $_GET["id"];

$stmt = $bd->prepare("SELECT * FROM mascota WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$mascota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$mascota) {
    header("Location: index.php");
    exit();
}

require_once "template/header.php"; 
?>

<div class="container">
    <h1 class="my-4">Eliminar cliente</h1>

    <p>¿Está seguro que desea eliminar a "<?php echo $mascota["nombre"]; ?>"?</p>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $mascota["id"]; ?>">
        <button type="submit" class="btn btn-danger">Eliminar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once "template/footer.php"; // Incluimos el archivo del pie de página ?>