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

  
    public function edit($param_basura = null)
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = 'ID de cliente inválido.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $cliente_edit = $this->clienteModel->find($id);
        
        if (!$cliente_edit) {
            $_SESSION['error'] = 'Cliente no encontrado en la base de datos.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $clientes = $this->clienteModel->getAllWithDetails();
        $actividades = $this->clienteModel->getActividadesEconomicas();
        $departamentos = $this->clienteModel->getDepartamentos();
        $tiposContribuyente = $this->clienteModel->getTiposContribuyente();
        $tiposDocumento = $this->clienteModel->getTiposDocumento();
        $municipios = $this->clienteModel->getTodosLosMunicipios();

        $this->view('clientes/index', [
            'title' => 'Editar Cliente',
            'clientes' => $clientes,
            'actividades' => $actividades,
            'departamentos' => $departamentos,
            'tiposContribuyente' => $tiposContribuyente,
            'tiposDocumento' => $tiposDocumento,
            'municipios' => $municipios,
            'cliente_edit' => $cliente_edit 
        ]);
    }

    // Actualizar cliente
    public function update($param_basura = null)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = 'ID de cliente inválido al intentar actualizar.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $errores = ClienteValidator::validarCreacion($_POST);

        if (!empty($errores)) {
            $_SESSION['error'] = implode('<br>', $errores);
            header('Location: ' . APP_URL . '/clientes/edit?id=' . $id); 
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

        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($this->clienteModel->update($id, $data)) {
            $_SESSION['success'] = 'Cliente actualizado correctamente.';
        } else {
            $_SESSION['error'] = 'Error interno al actualizar en la base de datos.';
        }

        header('Location: ' . APP_URL . '/clientes');
        exit;
    }

    // Ver detalles del cliente
    public function show($param_basura = null)
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = 'ID de cliente inválido.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $cliente = $this->clienteModel->getClientWithFullDetails($id);

        if (!$cliente) {
            $_SESSION['error'] = 'Cliente no encontrado.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        $this->view('clientes/show', [
            'title' => 'Perfil del Cliente',
            'cliente' => $cliente
        ]);
    }

    // Eliminar cliente
    public function delete($param_basura = null)
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $_SESSION['error'] = 'ID de cliente inválido.';
            header('Location: ' . APP_URL . '/clientes');
            exit;
        }

        if ($this->clienteModel->delete($id)) {
            $_SESSION['success'] = 'Cliente eliminado correctamente.';
        } else {

            $_SESSION['error'] = 'No se pudo eliminar. Es posible que el cliente tenga registros o comprobantes asociados.';
        }

        header('Location: ' . APP_URL . '/clientes');
        exit;
    }
}