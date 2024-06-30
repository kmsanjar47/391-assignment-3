<?php
// fetch_appointments.php
$conn = new mysqli('localhost', 'username', 'password', 'car_workshop');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT a.id, c.name AS client_name, c.phone, c.car_license_number, a.appointment_date, m.name AS mechanic_name 
        FROM appointments a
        JOIN clients c ON a.client_id = c.id
        JOIN mechanics m ON a.mechanic_id = m.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['client_name']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['car_license_number']}</td>
                <td>{$row['appointment_date']}</td>
                <td>{$row['mechanic_name']}</td>
                <td><button onclick='editAppointment({$row['id']})'>Edit</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No appointments found</td></tr>";
}

$conn->close();
?>
