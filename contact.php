<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Set your email address where you want to receive the emails
    $recipient = "bandarisandeep26@gmail.com";

    // Set your email subject line
    $email_subject = "New message from $name about $subject";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    if(mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Success message
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        // Error message
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Error message
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
