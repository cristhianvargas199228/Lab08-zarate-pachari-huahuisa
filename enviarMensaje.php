<?php
if (!isset($_GET['id'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$id = $_GET['id'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_mascota , per.nombre , per.raza , per.fecha_atencion, per.celular 
  FROM promociones pro 
  INNER JOIN mascota per ON per.id = pro.id_mascota
  WHERE pro.id = ?;");
$sentencia->execute([$id]);
$mascota = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101817426/SendMessage/bdd2f4305e1a44838b3c7cc78496a3f33fa98b498de543db94';
    $data = [
        "chatId" => "51".$mascota->celular."@c.us",
        "message" =>  'Buen dia mi Estimado(a), hoy por ser nuestro leal cliente tu pequeño compañero(a)  *'.strtoupper($mascota->nombre).'* te brinda la oportunidad de no perderte el *'.strtoupper($mascota->promocion).'* valido solo *'.$mascota->duracion.'* No te pierdas esta oportunidad y animate a engreir a tu buen amigo fiel!! 🐶 '
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
?> 