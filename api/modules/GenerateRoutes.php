<?php
namespace generate_routes;
class GenerateRoutes
{
    static $apiDir = __DIR__ . '/../routes';
    public static function generate()
    {
        $modules_dir = self::$apiDir;
        $routes = self::discoverRoutes($modules_dir);
        self::generateFunctionsFile($routes);
        echo "\nRoutes functions generated successfully.\n";
    }
    private static function discoverRoutes($dir)
    {
        $routes = [];
        if (is_dir($dir)) {
            $items = scandir($dir);
            foreach ($items as $item) {
                if ($item !== '.' && $item !== '..') {
                    $path = $dir . '/' . $item;
                    if (is_dir($path)) {
                        $route_file = $path . '/index.php';
                        if (file_exists($route_file)) {
                            $relative_path = str_replace(self::$apiDir, '', $path);
                            $routes[] = $relative_path;
                        }
                        $routes = array_merge($routes, self::discoverRoutes($path));
                    }
                }
            }
        } else {
            error_log("Modules directory $dir does not exist");
        }
        $functions_file_path = __DIR__ . '/../routes.json';
        return $routes;
    }
    private static function generateFunctionsFile($routes)
    {
        // $functions_content = "<?php\n\n";
        $functions_content = "add_action('rest_api_init', function () {\n";
        $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
        foreach ($routes as $route) {
            $route = trim($route, '/');
            $callback_function = file_get_contents(__DIR__ . "/../routes/" . $route . "/index.php");
            $callback_function = preg_replace('/^<\?php\s*/', '', $callback_function);
            $functions_content .= "    register_rest_route('api', '$route', array(\n";
            $functions_content .= "        'methods' => array('" . implode("', '", $methods) . "'),\n";
            $functions_content .= "        'callback' => function (\$request) {\n";
            $functions_content .= "            $callback_function\n";
            $functions_content .= "        },\n";
            $functions_content .= "    ));\n";
        }
        $functions_content .= "});\n";
        $functions_file_path = __DIR__ . '/../routes.php';
        $encrypted_content = self::encryptContent($functions_content);
        $encrypted_content = "<?php $encrypted_content ?>";
        file_put_contents($functions_file_path, $encrypted_content);
        echo "Generated functions file: $functions_file_path\n";
    }
    private static function encryptContent($content)
    {
        return self::obfuscate($content);
    }
    static function obfuscate($code)
    {
        $code = self::obfuscateVariables($code);
        $code = self::obfuscateFunctions($code);
        $code = self::removeTabsSpacesAndComments($code);
        return $code;
    }
    static function obfuscateVariables($code)
    {
        preg_match_all('/\$[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*/', $code, $matches);
        $variables = array_unique($matches[0]);
        $replacement = [];

        foreach ($variables as $var) {
            $replacement[$var] = '$' . self::generateRandomString();
        }

        return str_replace(array_keys($replacement), array_values($replacement), $code);
    }
    static function  obfuscateFunctions($code)
    {
        preg_match_all('/function\s+([a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*)/', $code, $matches);
        $functions = array_unique($matches[1]);
        $replacement = [];

        foreach ($functions as $func) {
            $replacement[$func] = self::generateRandomString();
        }

        return str_replace(array_keys($replacement), array_values($replacement), $code);
    }
    static function  generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
    static function removeTabsSpacesAndComments($code)
    {
        $code = preg_replace('!/\*.*?\*/!s', '', $code);
        // $code = preg_replace('/\/\/.*\n/', "\n", $code); 
        $code = preg_replace('/(?<!:)\/\/.*$/m', '', $code);
        $code = preg_replace('/\t+/', '', $code); 
        $code = preg_replace('/\s+/', ' ', $code); 
        $code = preg_replace('/\s*\n\s*/', "\n", $code);
        return $code;
    }
}