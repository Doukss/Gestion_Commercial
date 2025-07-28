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
    extract($data, EXTR_SKIP);
    $viewFile = ROOT_PATH . "/views/{$view}.html.php";

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
    include $_ENV['ROOT_PATH'] . "/views/components/{$component}.php";
}

function include_required($component, $data = [])
{
    extract($data);
    include $_ENV['ROOT_PATH'] . "/includes/{$component}.php";
}