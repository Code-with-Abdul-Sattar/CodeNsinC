<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables for success/error messages
$messageSent = false;
$errorMessage = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    // Validate the form fields
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        $errorMessage = "Please fill out all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    } else {
        // Set the recipient email address
        $recipient = "juniorsattar@gmail.com";  // Replace with your actual email

        // Set the email subject
        $subject = "New Contact Form Submission from $name";

        // Build the email content
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Phone: $phone\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers
        $email_headers = "From: $name <$email>";

        // Send the email and check for success
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            $messageSent = true;
        } else {
            $errorMessage = "Oops! Something went wrong, and we couldn't send your message.";
        }
    }
}
?>

