<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "volkstuinen";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $reason = $_POST['reason'];
    $parcel = $_POST['parcel'];
    $metres = $_POST['M2'];

    // Insert into 'requests' table – now with Motive, Parcel, and Metres
    $sql = "INSERT INTO `parcel-requests` (Motive, Parcel, M2) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $reason, $parcel, $metres); // s = string, i = integer
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    header("Location: http://localhost/volkstuinen/Frontend/Formulier/Bedankt.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grond Aanvragen - Volkstuin Vereniging Sittard</title>
  <link rel="stylesheet" href="aanvraag-parceel.css">
</head>
<body>
  
<div class="sidebar">
    <img src="../Gedeeld/pictures/logo-volkstuinverenigingsittard.png" alt="Logo">

    <div class="Icoontjes">
      <a href="dashboard.php">
        <div class="icon1">
          <img src="../Gedeeld/pictures/HomeMenuButton.svg" alt="Dashboard">
        </div>
      </a>
      <a href="../../Frontend/Gedeeld/GebruikerInfo.php">
        <div class="icon2">
          <img src="../Gedeeld/pictures/UserMenuButton.svg" alt="Gebruikersinstellingen">
        </div>
      </a>
      <a href="../../Frontend/logout.php">
        <div class="icon3">
          <img src="../Gedeeld/pictures/ExitMenuButton.svg" alt="Uitloggen">
        </div>
      </a>
    </div>
  </div>

  <div class="header">VOLKSTUIN VERENING SITTARD</div>

  <div class="content">
    <h1>Grond aanvragen</h1>
    <div class="form-container">
      <form action="" method="POST">
        <label for="parcel">Parceel:</label>
        <select id="parcel" name="parcel" required>
          <option value="" disabled selected>Selecteer een Perceel</option>
          <?php
            // Connect to the database
            $servername = "localhost"; // Database server
            $username = "root";        // Database username
            $password = "";            // Database password
            $dbname = "volkstuinen";  // Database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch Complex data from 'parcel-free' table
            $sql = "SELECT * FROM parcel_free";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data for each row
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['Complex'] . '">' . $row['Complex'] . '</option>';
                }
            } else {
                echo '<option value="">Geen beschikbare percelen</option>';
            }

            // Close the connection
            $conn->close();
          ?>
        </select>
        <label for="M2">Aantal meters (meter(s)):</label>
<input type="number" id="M2" name="M2" min="1" required>

        <label for="reason">Reden voor aanvraag:</label>
        <textarea id="reason" name="reason" rows="4" placeholder="Beschrijf uw reden voor deze aanvraag" required></textarea>

        <button type="submit">Verstuur aanvraag</button>
        </center>
      </form>
    </div>
  </div>
</body>
</html>
