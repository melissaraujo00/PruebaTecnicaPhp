<?php
class Controller
{
    // Cargar una vista
    protected function view($view, $data = [])
    {
        extract($data);  
        $viewFile = APP_ROOT . "/Views/{$view}.php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Vista no encontrada: {$view}");
        }
    }

    // Cargar un modelo
    protected function model($model)
    {
        $modelClass = ucfirst($model) . 'Model';
        $modelFile = APP_ROOT . "/Models/{$modelClass}.php";
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $modelClass();
        }
        die("Modelo no encontrado: {$modelClass}");
    }
}