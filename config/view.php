<?php

if (!function_exists("real_path_or_default")) {
    function real_path_or_default($path) {
        if (!file_exists($path)) {
            @mkdir($path, 0777, true);
        }
        return $path;
    }
}

return [
    "paths" => [
        resource_path("views"),
    ],
    "compiled" => env(
        "VIEW_COMPILED_PATH",
        real_path_or_default(storage_path("framework/views"))
    ),
];
