<?php

$method = $request->get_method();

if ($method === "POST") {
    $recaptcha_response = sanitize_text_field($request->get_param('g-recaptcha-response'));
    if (GoogleRecaptchaHelper::check($recaptcha_response)) {
        $endpoint = "https://us20.api.mailchimp.com/3.0/lists/097d5bf684/members";
        $apiKey = "ba47ab27857165e041feb0aa18cdd726-us20";
        $additionalHeaders = [
            'Authorization' => "Basic " . base64_encode('user:' . $apiKey),
        ];
        $data = [
            'email_address' => $response->email,
            'status' => 'subscribed'
        ];
        $email = sanitize_email($request->get_param('email'));

        if (empty($email)) {
            return new WP_REST_Response([
                'status' => 'error',
                'message' => "Required email field!",
            ], 400);
        }
        if (!is_email($email)) {
            return new WP_REST_Response([
                'status' => 'error',
                'message' => "Invalid email address.",
            ], 400);
        }

        $response = HttpHelper::sendRequest($endpoint, $method, $data, $additionalHeaders);
        $response = json_decode($response);

        if ($response && is_object($response)) {
            if (property_exists($response, 'status')) {
                $status = $response->status;
                if ($status == 'subscribed') {
                    wp_mail("hello@hijrstudio.com", $response->email . ' Subscription Success', $response->email . ' success', $headers);
                    wp_mail("zarralghifari@gmail.com", $response->email . ' Subscription Success', $response->email . ' success', $headers);
                    return new WP_REST_Response([
                        'status' => 'success',
                        'message' => "Subscription successful! Thank you.",
                    ], 200);
                } else {
                    return new WP_REST_Response([
                        'status' => 'error',
                        'message' => "Subscription failed. Status: $response->title",
                    ], 400);
                }
            } else {
                return new WP_REST_Response([
                    'status' => 'error',
                    'message' => "Subscription failed. Status information not available.",
                ], 400);
            }
        }
    }
    return new WP_REST_Response([
        'status' => 'error',
        'message' => "Subscription failed. Please try again.",
    ], 400);
}
if ($method == "GET") {
    return "ok";
}

return new WP_REST_Response([
    'status' => 404,
], 404);
