<?php
require_once APP_ROOT . '/Core/Controller.php';

class ClienteController extends Controller
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = $this->model('Cliente');
    }

    // Listar clientes Y cargar datos del formulario
    public function index()
    {
        $clientes = $this->clienteModel->getAllWithDetails();
        $actividades = $this->clienteModel->getActividadesEconomicas();
        $departamentos = $this->clienteModel->getDepartamentos();
        $tiposContribuyente = $this->clienteModel->getTiposContribuyente();
        $tiposDocumento = $this->clienteModel->getTiposDocumento();
        $municipios = $this->clienteModel->getTodosLosMunicipios();

        $this->view('clientes/index', [
            'title' => 'Listado de Clientes',
            'clientes' => $clientes,
            'actividades' => $actividades,
            'departamentos' => $departamentos,
            'tiposContribuyente' => $tiposContribuyente,
            'tiposDocumento' => $tiposDocumento,
            'municipios' => $municipios 
        ]);
    }


}