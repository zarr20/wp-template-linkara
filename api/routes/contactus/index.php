<?php

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
    $recaptcha_response = sanitize_text_field($request->get_param('g-recaptcha-response'));
    if (GoogleRecaptchaHelper::check($recaptcha_response)) {
        $name = sanitize_text_field($request->get_param('name'));
        $email = sanitize_email($request->get_param('email'));
        $telp = sanitize_text_field($request->get_param('phone'));
        $subject = sanitize_text_field($request->get_param('subject'));
        $message = sanitize_textarea_field($request->get_param('message'));
        if (empty($name) || empty($email) || empty($telp) || empty($subject) || empty($message)) {
            return new WP_REST_Response(array(
                'status' => 'error',
                'message' => "All fields are required.",
            ), 400);
        }
        if (!is_email($email)) {
            return new WP_REST_Response(array(
                'status' => 'error',
                'message' => "Invalid email address.",
            ), 400);
        }
        $to = "zarralghifari@gmail.com";
        $body = "Name: $name\nEmail: $email\nPhone: $telp\nSubject: $subject\nMessage: $message";
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        $sent = wp_mail($to, $subject, $body, $headers);
        if ($sent) {
            $sent = wp_mail("hello@hijrstudio.com", $subject, $body, $headers);
            return new WP_REST_Response(array(
                'status' => 'success',
                'message' => "Your message has been sent successfully.",
            ), 200);
        }
    }

    return new WP_REST_Response(array(
        'status' => 'error',
        'message' => "Failed to send your message.",
    ), 500);
}

return new WP_REST_Response(array(
    'status' => 404,
), 404);
