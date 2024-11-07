<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "covoiturage");
$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $genre = $_POST['genre'];
    $date_naissance = $_POST['date_naissance'];

    $nom = mysqli_real_escape_string($conn, $nom);
    $prenom = mysqli_real_escape_string($conn, $prenom);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $genre = mysqli_real_escape_string($conn, $genre);

$sql = "INSERT INTO conducteur (Nom, Prenom, Adresse_mail, Mot_de_passe, Genre ,Date_de_naissance ) VALUES ('$nom', '$prenom', '$email', '$password', '$genre' ,'$date_naissance')";

    if ($conn->query($sql) === TRUE) {
        header("Location: conduct_cmpt.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
