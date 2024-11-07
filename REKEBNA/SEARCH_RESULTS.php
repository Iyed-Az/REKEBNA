<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "covoiturage");

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);


if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$departure = mysqli_real_escape_string($connection, $_GET['departure']);
$destination = mysqli_real_escape_string($connection, $_GET['destination']);
$tripDate = mysqli_real_escape_string($connection, $_GET['tripDate']);
$passengerCount = intval($_GET['passengerCount']);

$sql = "SELECT * FROM trajet WHERE Lieu_départ = ? AND Lieu_arrivé = ? AND Date_départ = ? AND Nombre_place >= ?";
$stmt = $connection->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssi", $departure, $destination, $tripDate, $passengerCount);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>REKEBNA - Search Results</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <style>
                body {
                    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    background-color: #161b28;
                    color: #fff;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                header {
                    background-color: #0d1220;
                    width: 100%;
                    padding: 20px;
                    text-align: left;
                    position: fixed;
                    top: 0;
                    left: 0;
                    z-index: 1000;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                header h1 {
                    margin: 0;
                    font-size: 24px;
                    color: #fff;
                }
                .signup-icon {
                    color: #fff;
                    font-size: 24px;
                    margin-left: auto;
                    margin-right: 30px;
                }
                main {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    width: 100%;
                    padding: 100px 20px 20px;
                    box-sizing: border-box;
                    margin-top: 80px;
                }
                .boxes-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    width: 100%;
                    max-width: 800px;
                    margin-top: 20px;
                }
                .box {
                    width: calc(50% - 20px);
                    background-color: #0d1220;
                    padding: 20px;
                    border-radius: 10px;
                    margin-bottom: 20px;
                    box-sizing: border-box;
                }
                .box h3 {
                    font-size: 18px;
                    margin-bottom: 10px;
                }
                .box p {
                    font-size: 14px;
                    margin-bottom: 8px;
                }
                @media (max-width: 768px) {
                    .box {
                        width: 100%;
                    }
                }
                footer {
                    background-color: #363b49;
                    width: 100%;
                    text-align: center;
                    padding: 20px 0;
                    color: #fff;
                }
                footer nav ul {
                    list-style-type: none;
                    padding: 0;
                    margin: 0;
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                }
                footer nav ul li {
                    margin: 10px 0;
                }
                footer nav ul li a {
                    color: #fff;
                    text-decoration: none;
                    font-size: 16px;
                    font-weight: bold;
                    transition: color 0.3s ease;
                }
                footer nav ul li a:hover {
                    color: #adb5bd;
                }
            </style>
        </head>
        <body>
            <header>
                <h1>REKEBNA</h1>
                <a href="LOGIN_PAGE.html" class="signup-icon"><i class="fas fa-user-plus"></i></a>
            </header>
            <main>
            <img src="carpool_blablabus_large-e3d8eff32c13cdafc080.svg" alt="web pick" height="550px" width="100%" loading="eager" decoding="sync" fetchpriority="high">
                <div class="boxes-container" id="rideBoxes">';

        while ($row = $result->fetch_assoc()) {
            echo '<div class="box">';
            echo '<h3>' . htmlspecialchars($row['Lieu_départ']) . ' to ' . htmlspecialchars($row['Lieu_arrivé']) . '</h3>';
            echo '<p><strong>Departure Date:</strong> ' . htmlspecialchars($row['Date_départ']) . '</p>';
            echo '<p><strong>Departure Time:</strong> ' . htmlspecialchars($row['Heure_départ']) . '</p>';
            echo '<p><strong>Arrival Time:</strong> ' . htmlspecialchars($row['Heure_arrivé']) . '</p>';
            echo '<p><strong>Price:</strong> ' . htmlspecialchars($row['Prix']) . ' DA</p>';
            echo '<p><strong>Available Seats:</strong> ' . htmlspecialchars($row['Nombre_place']) . '</p>';
            echo '</div>';
        }

        echo '<div>
            </main>
    <footer>
        <nav>
            <ul
                <li>Contact: <br>Tel:05 57 22 24 81 OR 06 75 10 05 26<br>Mail: Support@REKEBNA.com<br>Address: sidi ammar Annaba 23000</li>
                <li>Quick links: <br><a href="C:\xampp\htdocs\REKEBNA\LOGIN_PAGE.html">Register</a><br><a href="#message">Send a message</a><br><a href="#">Who are we</a></li>
                <li>Miscellaneous information: <br><a href="#">Our partners</a><br><a href="#">Our regional headquarters</a></li>
            </ul>
        </nav>
    </footer>
             </div'
                ;}
    } 