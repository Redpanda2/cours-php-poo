<?php

function render(string $path, array $variables = [])
{
    extract($variables, EXTR_PREFIX_SAME, 'v');
    ob_start();
    require('templates/' . $path . '.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
}



function  redirect(string $url): void
{
    header("Location: $url");
    exit();
}
