<?php

class Renderer
{
    public static function render(string $path, array $variables = [])
    {
        extract($variables);
        ob_start();
        require('views/' . $path . '.php');
        $pageContent = ob_get_clean();
        require('views/template.php');
        unset($_SESSION['message']);
    }
}