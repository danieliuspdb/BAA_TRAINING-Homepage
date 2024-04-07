<?php
$firstName = $_POST["firstName"];
$phoneNumber = $_POST["phoneNumber"];
$email = $_POST["email"];
$country = $_POST["country"];
$message = $_POST["message"];
$subscribe = isset($_POST["subscribe"]) ? $_POST["subscribe"] : '';
$terms = isset($_POST["terms"]) ? $_POST["terms"] : '';

$errors = array();

if (empty($firstName)) {
    $errors[] = "Name is required.";
}

if (empty($phoneNumber)) {
    $errors[] = "Phone number is required.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || (strpos($email, '@') === false) || (strpos($email, '.') === false)) {
    $errors[] = "Valid email is required.";
}

if (empty($country)) {
    $errors[] = "Country is required.";
}

if (empty($errors)) {
    $to = "danieliuspodb@gmail.com";
    $subject = "New Contact Form Submission";

    $headers[] = "From: $email";
    $headers[] = "Content-Type: text/html; charset=UTF-8";

    $emailMessage = "Name: $firstName<br>";
    $emailMessage .= "Phone Number: $phoneNumber<br>";
    $emailMessage .= "Email: $email<br>";
    $emailMessage .= "Country: $country<br>";
    $emailMessage .= "Message: $message<br>";
    $emailMessage .= "Subscribe to Privacy Policy: $subscribe<br>";
    $emailMessage .= "Agree to Personal Data Processing: $terms<br>";

    if (wp_mail($to, $subject, $emailMessage, $headers)) {
        header("Location: custom-template.php?mailsend");
        exit();
    } else {
        echo "Error sending email. Please try again later.";
    }
} else {
    echo "Validation errors: " . implode(", ", $errors);
}
?>