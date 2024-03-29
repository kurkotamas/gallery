<?php

function classAutoLoader($class) {
    $class = strtolower($class);

    $the_path = "includes/{$class}.php";

    if(files_exists($the_path)) {
        require_once($the_path);
    } else {
        die("This file name {$class}.php was not found");
    }
}

function redirect($location) {
    header("Location: {$location}");
}