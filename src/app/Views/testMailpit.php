<?php
$connection = fsockopen('mailpit', 1025, $errno, $errstr, 5);
if (!$connection) {
    echo "Connection failed: $errstr ($errno)";
} else {
    echo "Connection successful!";
    fclose($connection);
}

$email = \Config\Services::email();

$email->setTo('recipient@example.com');
$email->setFrom('cvven@example.com', 'CVVEN');
$email->setSubject('Test Email');
$email->setMessage('<p>This is a test email sent via Mailpit!</p>');

if ($email->send()) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
    print_r($email->printDebugger(['headers', 'body']));
}

