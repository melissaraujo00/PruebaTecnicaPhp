<?php
require_once APP_ROOT . '/Core/Controller.php';
require_once APP_ROOT . '/helpers/ClienteValidator.php';
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

    // Guardar un cliente nuevo
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $errores = ClienteValidator::validarCreacion($_POST);

        if (!empty($errores)) {
            $_SESSION['error'] = implode('<br>', $errores);
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $campos_permitidos = [
            'tipo_cliente', 'cod_tipo_documento', 'dui_nit', 'nrc', 'nombre', 
            'nombre_comercial', 'telefono', 'correo', 'direccion', 'ciudad', 
            'cod_actividad_economica', 'cod_departamento', 'cod_municipio', 
            'fk_id_tipo_contribuyente', 'tipo_persona', 'fk_id_pais', 'descripcion_adicional'
        ];


        $data = [];
        foreach ($campos_permitidos as $campo) {
            $valor = $_POST[$campo] ?? null;
            $data[$campo] = (is_string($valor) && trim($valor) !== '') ? trim($valor) : null;
        }

        $data['tipo_persona'] = $data['tipo_persona'] ?? 1; 
        $data['fk_id_pais']   = $data['fk_id_pais'] ?? 87;  
        $data['created_at']   = date('Y-m-d H:i:s');
        $data['updated_at']   = date('Y-m-d H:i:s');

        if ($this->clienteModel->insert($data)) {
            $_SESSION['success'] = 'Cliente registrado exitosamente.';
        } else {
            $_SESSION['error'] = 'Hubo un error interno al intentar guardar el cliente.';
        }

        header('Location: ' . APP_URL . '/clientes');
        exit;
    }

}