<?php
// submit_appointment.php
$conn = new mysqli('localhost', 'username', 'password', 'car_workshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$car_color = $_POST['car_color'];
$car_license_number = $_POST['car_license_number'];
$car_engine_number = $_POST['car_engine_number'];
$appointment_date = $_POST['appointment_date'];
$mechanic_id = $_POST['mechanic'];

// Check if the client already has an appointment on the same date
$sql = "SELECT * FROM clients WHERE phone='$phone'";
$result = $conn->query($sql);
$client_id = null;

if ($result->num_rows > 0) {
    $client = $result->fetch_assoc();
    $client_id = $client['id'];

    $sql = "SELECT * FROM appointments WHERE client_id='$client_id' AND appointment_date='$appointment_date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        die("You already have an appointment on this date.");
    }
} else {
    // Insert new client
    $sql = "INSERT INTO clients (name, phone, car_color, car_license_number, car_engine_number) VALUES ('$name', '$phone', '$car_color', '$car_license_number', '$car_engine_number')";
    if ($conn->query($sql) === TRUE) {
        $client_id = $conn->insert_id;
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
    }
}

// Check if the mechanic has reached their max clients for the day
$sql = "SELECT COUNT(*) as count FROM appointments WHERE mechanic_id='$mechanic_id' AND appointment_date='$appointment_date'";
$result = $conn->query($sql);
$count = $result->fetch_assoc()['count'];

$sql = "SELECT max_clients_per_day FROM mechanics WHERE id='$mechanic_id'";
$result = $conn->query($sql);
$max_clients = $result->fetch_assoc()['max_clients_per_day'];

if ($count >= $max_clients) {
    die("This mechanic is fully booked for the day.");
} else {
    $sql = "INSERT INTO appointments (client_id, mechanic_id, appointment_date) VALUES ('$client_id', '$mechanic_id', '$appointment_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Appointment booked successfully.";
    } else {
        die("Error: " . $sql . "<br>" . $conn->error);
    }
}

$conn->close();
?>
