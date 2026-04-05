<?php

class ClienteValidator
{

    public static function validarCreacion($datos)
    {
        $errores = [];

        $tipo_cliente = $datos['tipo_cliente'] ?? null;
        $nombre = trim($datos['nombre'] ?? '');
        $cod_tipo_documento = $datos['cod_tipo_documento'] ?? null;
        $dui_nit = trim($datos['dui_nit'] ?? '');

        if (empty($tipo_cliente) || empty($nombre) || empty($cod_tipo_documento) || empty($dui_nit)) {
            $errores[] = 'Faltan campos obligatorios (Tipo de cliente, Nombre o N° Documento).';
        }

        if ($tipo_cliente == '2') {
            $nrc = trim($datos['nrc'] ?? '');
            if (empty($nrc)) {
                $errores[] = 'El NRC es obligatorio para los clientes de tipo Crédito Fiscal.';
            }
        } elseif ($tipo_cliente == '3') {
            $fk_id_pais = $datos['fk_id_pais'] ?? null;
            if (empty($fk_id_pais)) {
                $errores[] = 'Debe seleccionar el país de origen para el cliente extranjero.';
            }
        }

        return $errores;
    }
}