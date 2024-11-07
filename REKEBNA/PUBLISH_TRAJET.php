<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "covoiturage");
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($connection->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$date = $_POST['date'];
$places = $_POST['places'];
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$departureTime = $_POST['departureTime'];
$destinationTime = $_POST['destinationTime'];
$price = $_POST['price'];
$userid =0;
$sql = "INSERT INTO trajet (Date_départ, Nombre_place, Lieu_départ, Lieu_arrivé, Heure_départ, Heure_arrivé, Prix,ID_conducteur)
VALUES (?, ?, ?, ?, ?, ?, ?,?)";
$stmt = $connection->prepare($sql);
if($stmt) {
$stmt->bind_param("ssssssii", $date, $places, $departure, $destination, $departureTime, $destinationTime, $price,$userid);
if($stmt->execute()) {
header("SUCCED");
}
else {
echo "Erreur lors de l'insertion des données : " . $stmt->error;
}
$stmt->close();
} else {
echo "Erreur de préparation de la requête : " . $connection->error;
}
?>