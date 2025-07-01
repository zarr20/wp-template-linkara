<?php


class GoogleRecaptchaHelper
{
    public static function check($response)
    {
        $recaptcha_secret = "6LfO81UiAAAAAFQvmT0a1uaJGAOue-bUoPaZTTlI";
        $recaptcha_response = $response;
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $data = [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_response,
        ];

        $options = [
            'http' => [
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];



        try {
            $context  = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
            $result = json_decode($response, true);
            if (isset($result['success']) && $result['success'] == true) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
