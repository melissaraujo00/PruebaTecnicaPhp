<?php
require_once APP_ROOT . '/Core/Model.php';

class ClienteModel extends Model
{
    protected $table = 'venta_catalogo_cliente';

    // Obtener clientes con el nombre del tipo de documento y tipo contribuyente
    public function getAllWithDetails()
    {
        $sql = "SELECT c.*, 
                       td.tipo_documento, 
                       tc.tipo_contribuyente
                FROM {$this->table} c
                LEFT JOIN venta_mh_tipo_documento td ON c.cod_tipo_documento = td.cod_tipo_documento
                LEFT JOIN venta_mh_tipo_contribuyente tc ON c.fk_id_tipo_contribuyente = tc.id_tipo_contribuyente
                ORDER BY c.id_catalogo_cliente DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Lista de actividades económicas 
    public function getActividadesEconomicas()
    {
        $stmt = $this->db->query("SELECT id_actividad_economica, actividad_economica, cod_actividad_economica FROM venta_mh_actividad_economica WHERE estado = '1' ORDER BY actividad_economica");
        return $stmt->fetchAll();
    }

    // Lista de departamentos
    public function getDepartamentos()
    {
        $stmt = $this->db->query("SELECT id_departamento, departamento, cod_mh_departamento FROM venta_mh_departamento WHERE estado = '1' ORDER BY departamento");
        return $stmt->fetchAll();
    }

    // Lista de tipos de contribuyente
    public function getTiposContribuyente()
    {
        $stmt = $this->db->query("SELECT id_tipo_contribuyente, tipo_contribuyente FROM venta_mh_tipo_contribuyente WHERE estado = '1'");
        return $stmt->fetchAll();
    }

    // Lista de tipos de documento
    public function getTiposDocumento()
    {
        $stmt = $this->db->query("SELECT id_tipo_documento, tipo_documento, cod_tipo_documento FROM venta_mh_tipo_documento WHERE estado = '1'");
        return $stmt->fetchAll();
    }

    // Obtener TODOS los municipios 
    public function getTodosLosMunicipios()
    {
        $sql = "SELECT id_municipio, municipio, cod_mh_departamento 
                FROM venta_mh_municipio 
                ORDER BY municipio ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $columnas = implode(', ', array_keys($data));
        
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columnas) VALUES ($placeholders)";
        
        $stmt = $this->db->prepare($sql);

        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
    }


    // Actualiza un registro dinámicamente
    public function update($id, $data)
    {
        $campos = '';
        foreach ($data as $key => $value) {
            $campos .= "$key = :$key, ";
        }
        $campos = rtrim($campos, ', '); 
        $sql = "UPDATE {$this->table} SET $campos WHERE id_catalogo_cliente = :id";
        
        $data['id'] = $id;
        
        $stmt = $this->db->prepare($sql);

        try {
            return $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
    }
}