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

// Inicializamos las variables para los valores por defecto de los campos
$nombre = "";
$raza = "";
$vacunas = "";
$estilista = "";
$tipo_de_servicio = "";
$fecha_atencion = "";
$celular = "";

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenemos los valores enviados por el formulario
    $nombre = trim($_POST["nombre"]);
    $raza = trim($_POST["raza"]);
    $vacunas = trim($_POST["vacunas"]);
    $estilista = trim($_POST["estilista"]);
    $tipo_de_servicio = trim($_POST["tipo_de_servicio"]);
    $fecha_atencion = trim($_POST["fecha_atencion"]);
    $celular = trim($_POST["celular"]);

    // Validamos los datos ingresados por el usuario
    $errores = [];

    // Validamos que se haya ingresado un nombre
    if (empty($nombre)) {
        $errores["nombre"] = "Debe ingresar el nombre de la mascota";
    }

    // Validamos que se haya ingresado una raza
    if (empty($raza)) {
        $errores["raza"] = "Debe ingresar la raza de la mascota";
    }

    // Validamos que se haya ingresado el tipo de servicio
    if (empty($tipo_de_servicio)) {
        $errores["tipo_de_servicio"] = "Debe ingresar el tipo de servicio";
    }

    // Si no hay errores, insertamos los datos en la base de datos
    if (empty($errores)) {
        // Preparamos la consulta SQL para insertar los datos en la tabla mascota
        $stmt = $bd->prepare("INSERT INTO mascota (nombre, raza, vacunas, estilista, tipo_de_servicio, fecha_atencion, celular) VALUES (:nombre, :raza, :vacunas, :estilista, :tipo_de_servicio, :fecha_atencion, :celular)");

        // Asignamos los valores de los parámetros de la consulta
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":raza", $raza);
        $stmt->bindParam(":vacunas", $vacunas);
        $stmt->bindParam(":estilista", $estilista);
        $stmt->bindParam(":tipo_de_servicio", $tipo_de_servicio);
        $stmt->bindParam(":fecha_atencion", $fecha_atencion);
        $stmt->bindParam(":celular", $celular);

        // Ejecutamos la consulta SQL
        $stmt->execute();

        // Redirigimos al usuario a la página principal
        header("Location: index.php");
        exit();
    }
    
    
}

?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <form method="POST">
        <div class="form-group">
          <label for="nombre">Nombre de su can</label>
          <input type="text" name="nombre" id="nombre" class="form-control <?php echo isset($errores["nombre"]) ? "is-invalid" : "" ?>" value="<?php echo $nombre ?>" />
          <?php if (isset($errores["nombre"])) : ?>
            <div class="invalid-feedback">
              <?php echo $errores["nombre"] ?>
            </div>
          <?php endif ?>
        </div>

        <div class="form-group">
          <label for="raza">Raza de su perro</label>
          <input type="text" name="raza" id="raza" class="form-control <?php echo isset($errores["raza"]) ? "is-invalid" : "" ?>" value="<?php echo $raza ?>" />
          <?php if (isset($errores["raza"])) : ?>
            <div class="invalid-feedback">
              <?php echo $errores["raza"] ?>
            </div>
          <?php endif ?>
        </div>

        <div class="form-group">
          <label for="vacunas">Vacunas</label>
          <input type="text" name="vacunas" id="vacunas" class="form-control" value="<?php echo $vacunas ?>" />
        </div>

        <div class="form-group">
          <label for="estilista">Estilista</label>
          <input type="text" name="estilista" id="estilista" class="form-control" value="<?php echo $estilista ?>" />
        </div>

        <div class="form-group">
          <label for="tipo_de_servicio">Tipo de servicio</label>
          <input type="text" name="tipo_de_servicio" id="tipo_de_servicio" class="form-control <?php echo isset($errores["tipo_de_servicio"]) ? "is-invalid" : "" ?>" value="<?php echo $tipo_de_servicio ?>" />
          <?php if (isset($errores["tipo_de_servicio"])) : ?>
            <div class="invalid-feedback">
              <?php echo $errores["tipo_de_servicio"] ?>
            </div>
          <?php endif ?>
        </div>

        <div class="form-group">
          <label for="fecha_atencion">Fecha de atención</label>
          <input type="date" name="fecha_atencion" id="fecha_atencion" class="form-control" value="<?php echo $fecha_atencion ?>" />
        </div>

        <div class="form-group">
          <label for="celular">Celular Dueño</label>
          <input type="text" name="celular" id="celular" class="form-control <?php echo isset($errores["celular"]) ? "is-invalid" : "" ?>" value="<?php echo $celular ?>" />
          <?php if (isset($errores["celular"])) : ?>
          <?php endif ?>
        </div>
        
        <div class="text-center">
          <button type="submit" class="btn btn-primary"> Registrar </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once "template/footer.php"; ?>