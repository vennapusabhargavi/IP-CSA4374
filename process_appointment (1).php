<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $notes = htmlspecialchars($_POST['notes']);

    // Here you would typically save the data to a database or send an email
    // For demonstration purposes, we'll just create a confirmation message

    $message = "Appointment Request:\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "Service: $service\n";
    $message .= "Date: $date\n";
    $message .= "Time: $time\n";
    $message .= "Notes: $notes\n";

    // Send confirmation email (example)
    $to = $email; // Send confirmation to the user
    $subject = "Appointment Confirmation";
    $headers = "From: no-reply@beautyparlour.com";
    mail($to, $subject, $message, $headers);

    // Optionally, you can also save the appointment details in a database

    // Redirect to a confirmation page
    header("Location: confirmation.php");
    exit();
} else {
    // If the form wasn't submitted via POST method, redirect to the form page
    header("Location: appointment.html");
    exit();
}
?>
