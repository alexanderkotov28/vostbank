<?php

spl_autoload_register(function ($class) use ($autoloader_mapping, $autoloader_base_dir) {
    foreach ($autoloader_mapping as $ns => $path) {
        $path = $autoloader_base_dir . $path;
        $len = strlen($ns);

        if (strncmp($ns, $class, $len) === 0) {
            $path .= substr($class, $len) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
        }
    }
});