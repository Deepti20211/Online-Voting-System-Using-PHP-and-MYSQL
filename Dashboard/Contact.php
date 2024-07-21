<?php
echo "<p>Request method is: " . $_SERVER["REQUEST_METHOD"] . "</p>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    echo "<p>Form data received:</p>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Message: $message</p>";

    // Email parameters
    $to = "dipti2018793@gmail.com"; 
    $subject = "New Contact Form Submission";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email body
    $body = "<h2>Contact Form Submission</h2>";
    $body .= "<p><strong>Name:</strong> {$name}</p>";
    $body .= "<p><strong>Email:</strong> {$email}</p>";
    $body .= "<p><strong>Message:</strong><br>{$message}</p>";

  
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Thank you! Your message has been sent.</p>";
    } else {
        echo "<p>Sorry, something went wrong. Please try again later.</p>";
    }
    
} else {
    echo "<p>Invalid request method. Current request method is: " . $_SERVER["REQUEST_METHOD"] . "</p>";
}
?>
