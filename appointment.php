<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beauty";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $notes = htmlspecialchars($_POST['notes']);

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, service, date, time, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $service, $date, $time, $notes);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to confirmation page
        header("Location: confirmation.html?name=" . urlencode($name) . "&email=" . urlencode($email) . "&phone=" . urlencode($phone) . "&service=" . urlencode($service) . "&date=" . urlencode($date) . "&time=" . urlencode($time) . "&notes=" . urlencode($notes));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the form wasn't submitted via POST
    echo "Please submit the form.";
}

// Close the connection
$conn->close();
?>
