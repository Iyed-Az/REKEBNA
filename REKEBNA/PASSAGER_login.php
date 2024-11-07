<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "covoiturage");
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($connection->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    $nom = mysqli_real_escape_string($connection, $nom);
    $prenom = mysqli_real_escape_string($connection, $prenom);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $age = (int)$_POST['age'];

   
 $sql = "INSERT INTO passager (Nom, Prenom, Adresse_mail, Mot_de_passe, Age) VALUES ('$nom', '$prenom', '$email', '$password', $age)";
 
 if ($connection->query($sql) === TRUE) {
    header("Location: passager_cmpt.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
$connection->close();
?>
