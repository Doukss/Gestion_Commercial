<?php
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    die;
    echo "</pre>";
}


function render_view($view, $layoutPath, $data = [])
{
    extract($data);
    $viewFile = ROOT_PATH . "/views/pages/{$view}.html.php";

    if (!file_exists($viewFile)) {
        throw new Exception("View {$view} not found");
    }

    // dumpDie($viewFile);

    // Capture du contenu
    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    // Layout par défaut
    $layoutFile = ROOT_PATH . "/views/layout/{$layoutPath}.html.php";
    if (file_exists($layoutFile)) {
        require $layoutFile;
    } else {
        echo $content;
    }
}


function include_component(string $component, array $data = [])
{
    extract($data);
    include ROOT_PATH . "/views/components/{$component}.php";
}

function include_required($component, $data = [])
{
    extract($data);
    include ROOT_PATH . "/views/includes/{$component}.php";
}

function is_request_method(string $method): bool
{
    return $_SERVER["REQUEST_METHOD"] === strtoupper($method);
}

function redirect_to(string $path = '/', array $queryParams = [], int $httpCode = 302): void
{
    $url = rtrim($path, '/');

    if (!empty($queryParams)) {
        $url .= '?' . http_build_query($queryParams);
    }
    if (headers_sent()) {
        throw new RuntimeException('Headers already sent, cannot redirect');
    }
    header("Location: " . $_ENV['WEB_ROOT'] . "{$url}", true, $httpCode);
    exit;
}