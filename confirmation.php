<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add some basic styling for the form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .appointment-form {
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .appointment-form h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }
        .appointment-form label {
            display: block;
            margin: 0.5rem 0 0.2rem;
        }
        .appointment-form input, .appointment-form textarea {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .appointment-form button {
            background: #f09;
            color: #fff;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        .appointment-form button:hover {
            background: #e08;
        }
        .confirmation-message {
            max-width: 600px;
            margin: 2rem auto;
            padding: 1.5rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="appointment-form">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect and sanitize form data
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $date = htmlspecialchars($_POST['date']);
            $time = htmlspecialchars($_POST['time']);
            $notes = htmlspecialchars($_POST['notes']);

            // Prepare the email content
            $to = $email;
            $subject = "Appointment Confirmation - Beauty Parlour";
            $message = "
                <html>
                <head>
                    <title>Appointment Confirmation</title>
                </head>
                <body>
                    <h2>Thank you for booking an appointment with us!</h2>
                    <p>Dear $name,</p>
                    <p>Your appointment has been successfully booked. Here are the details:</p>
                    <table>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td>$name</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>$email</td>
                        </tr>
                        <tr>
                            <td><strong>Phone:</strong></td>
                            <td>$phone</td>
                        </tr>
                        <tr>
                            <td><strong>Preferred Date:</strong></td>
                            <td>$date</td>
                        </tr>
                        <tr>
                            <td><strong>Preferred Time:</strong></td>
                            <td>$time</td>
                        </tr>
                        <tr>
                            <td><strong>Additional Notes:</strong></td>
                            <td>$notes</td>
                        </tr>
                    </table>
                    <p>We look forward to seeing you!</p>
                    <p>Best regards,<br>Beauty Parlour Team</p>
                </body>
                </html>
            ";

            // Set content-type header for HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Additional headers
            $headers .= 'From: no-reply@beautyparlour.com' . "\r\n";

            // Send email
            if (mail($to, $subject, $message, $headers)) {
                echo "<div class='confirmation-message'>Appointment booked successfully! A confirmation email has been sent to you.</div>";
            } else {
                echo "<div class='confirmation-message'>Sorry, there was an error processing your appointment. Please try again.</div>";
            }
        } else {
        ?>
            <h2>Book an Appointment</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>
                
                <label for="date">Preferred Date:</label>
                <input type="date" id="date" name="date" required>
                
                <label for="time">Preferred Time:</label>
                <input type="time" id="time" name="time" required>
                
                <label for="notes">Additional Notes:</label>
                <textarea id="notes" name="notes" rows="4"></textarea>
                
                <button type="submit">Submit Appointment</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
