<?php
// fetch_mechanics.php
$conn = new mysqli('localhost', 'username', 'password', 'car_workshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM mechanics";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
} else {
    echo "<option>No mechanics available</option>";
}

$conn->close();
?>
