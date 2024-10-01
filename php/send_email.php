<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form inputs
    $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['Message'], FILTER_SANITIZE_STRING);

    // Email destination
    $to = "admin@developerruhban.com";
    $subject = "Contact Form Submission from " . $name . "developerruhban.com";

    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "to: " . $to . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email body
    $body = "
        <html>
        <head>
            <title>Contact Form Submission</title>
        </head>
        <body>
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong> $message</p>
        </body>
        </html>
    ";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect to thank you page or show success message
        header('Location: ' . $_POST['_next']);
        exit;
    } else {
        // Handle error
        echo "There was a problem sending the email.";
    }
}
?>
