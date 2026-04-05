<?php
if (!function_exists('render_component')) {
    
    function render_component($component_name, $props = []) {
        extract($props); 
        
        $path = APP_ROOT . '/views/components/' . $component_name . '.php';
        
        if (file_exists($path)) {
            require $path;
        } else {
            echo "";
        }
    }
}