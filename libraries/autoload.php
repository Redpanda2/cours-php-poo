<?php

spl_autoload_register(function ($classname) {
    //classname = Controllers\Article
    // require = libraries/controllers/Artice.php 
    $classname = lcfirst(str_replace('\\', '/', $classname));

    require_once("libraries/$classname.php");

    // var_dump($classname);
});
