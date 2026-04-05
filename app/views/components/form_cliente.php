<?php
// Lógica para saber si estamos en modo Edición o Creación
$isEdit = isset($cliente_edit) && !empty($cliente_edit);
$actionUrl = $isEdit ? APP_URL . '/clientes/update?id=' . $cliente_edit['id_catalogo_cliente'] : APP_URL . '/clientes/store';
$claseContenedor = $isEdit ? '' : 'd-none'; // Si edita, se muestra de inmediato
$tituloFormulario = $isEdit ? 'Editar Cliente' : 'Registrar Cliente';
?>

<div class="bg-white p-4 shadow-sm mb-4 form-accent-container <?= $claseContenedor ?>" id="contenedorFormulario">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-secondary mb-0 fw-bold"><?= $tituloFormulario ?></h5>
        <?php if($isEdit): ?>
            <a href="<?= APP_URL ?>/clientes" class="btn-close" aria-label="Cerrar"></a>
        <?php else: ?>
            <button type="button" class="btn-close" id="btnCerrarFormulario" aria-label="Cerrar"></button>
        <?php endif; ?>
    </div>

    <form action="<?= $actionUrl ?>" method="POST" id="formCrearCliente">
        
        <div class="row mb-4">
            <div class="col-md-12">
                <label class="form-label text-muted small fw-bold mb-1">Tipo de cliente</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none" name="tipo_cliente" id="tipo_cliente" required>
                    <option value="" <?= !$isEdit ? 'selected' : '' ?> disabled>Seleccione un tipo...</option>
                    <option value="1" <?= ($isEdit && $cliente_edit['tipo_cliente'] == 1) ? 'selected' : '' ?>>Consumidor final</option>
                    <option value="2" <?= ($isEdit && $cliente_edit['tipo_cliente'] == 2) ? 'selected' : '' ?>>Empresa / Crédito fiscal</option>
                    <option value="3" <?= ($isEdit && $cliente_edit['tipo_cliente'] == 3) ? 'selected' : '' ?>>Extranjero</option>
                    <option value="4" <?= ($isEdit && $cliente_edit['tipo_cliente'] == 4) ? 'selected' : '' ?>>Proveedor</option>
                </select>
            </div>
        </div>

        <div class="row <?= $isEdit ? '' : 'd-none' ?>" id="camposRestantes">
            
            <div class="col-md-4 mb-3 campo-dinamico" id="col_documento">
                <label class="form-label text-muted small fw-bold mb-1">Documento</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_tipo_documento" id="cod_tipo_documento">
                    <option value="">...</option>
                    <?php foreach($tiposDocumento as $doc): ?>
                        <option value="<?= $doc['id_tipo_documento'] ?>" <?= ($isEdit && $cliente_edit['cod_tipo_documento'] == $doc['id_tipo_documento']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($doc['tipo_documento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 mb-3 campo-dinamico" id="col_num_documento">
                <label class="form-label text-muted small fw-bold mb-1">N° Documento</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="dui_nit" id="dui_nit" value="<?= $isEdit ? htmlspecialchars($cliente_edit['dui_nit']) : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nrc">
                <label class="form-label text-muted small fw-bold mb-1">NRC / IVA</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nrc" id="nrc" value="<?= $isEdit ? htmlspecialchars($cliente_edit['nrc'] ?? '') : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nombre">
                <label class="form-label text-muted small fw-bold mb-1">Razón social / Nombre</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nombre" id="nombre" value="<?= $isEdit ? htmlspecialchars($cliente_edit['nombre']) : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nombre_comercial">
                <label class="form-label text-muted small fw-bold mb-1">Nombre comercial</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nombre_comercial" id="nombre_comercial" value="<?= $isEdit ? htmlspecialchars($cliente_edit['nombre_comercial'] ?? '') : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_telefono">
                <label class="form-label text-muted small fw-bold mb-1">Teléfono</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="telefono" id="telefono" value="<?= $isEdit ? htmlspecialchars($cliente_edit['telefono'] ?? '') : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_correo">
                <label class="form-label text-muted small fw-bold mb-1">Correo</label>
                <input type="email" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="correo" id="correo" value="<?= $isEdit ? htmlspecialchars($cliente_edit['correo'] ?? '') : '' ?>">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_giro">
                <label class="form-label text-muted small fw-bold mb-1">Giro</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_actividad_economica" id="cod_actividad_economica">
                    <option value="">...</option>
                    <?php foreach($actividades as $act): ?>
                        <option value="<?= $act['id_actividad_economica'] ?>" <?= ($isEdit && $cliente_edit['cod_actividad_economica'] == $act['id_actividad_economica']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($act['actividad_economica']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_tipo_contribuyente">
                <label class="form-label text-muted small fw-bold mb-1">Tipo contribuyente</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="fk_id_tipo_contribuyente" id="fk_id_tipo_contribuyente">
                    <option value="">...</option>
                    <?php foreach($tiposContribuyente as $tc): ?>
                        <option value="<?= $tc['id_tipo_contribuyente'] ?>" <?= ($isEdit && $cliente_edit['fk_id_tipo_contribuyente'] == $tc['id_tipo_contribuyente']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tc['tipo_contribuyente']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_tipo_persona">
                <label class="form-label text-muted small fw-bold mb-1">Tipo de persona</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="tipo_persona" id="tipo_persona">
                    <option value="1" <?= ($isEdit && $cliente_edit['tipo_persona'] == 1) ? 'selected' : '' ?>>Natural</option>
                    <option value="2" <?= ($isEdit && $cliente_edit['tipo_persona'] == 2) ? 'selected' : '' ?>>Jurídica</option>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_departamento">
                <label class="form-label text-muted small fw-bold mb-1">Departamento</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_departamento" id="cod_departamento">
                    <option value="">...</option>
                    <?php foreach($departamentos as $depto): ?>
                        <option value="<?= $depto['id_departamento'] ?>" <?= ($isEdit && $cliente_edit['cod_departamento'] == $depto['id_departamento']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($depto['departamento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_municipio">
                <label class="form-label text-muted small fw-bold mb-1">Municipio</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_municipio" id="cod_municipio">
                    <?php if($isEdit && !empty($cliente_edit['cod_departamento'])): ?>
                        <?php foreach($municipios as $mun): ?>
                            <?php if($mun['cod_mh_departamento'] == $cliente_edit['cod_departamento']): ?>
                                <option value="<?= $mun['id_municipio'] ?>" <?= ($cliente_edit['cod_municipio'] == $mun['id_municipio']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($mun['municipio']) ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Seleccione un departamento...</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_pais">
                <label class="form-label text-muted small fw-bold mb-1">País</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="fk_id_pais" id="fk_id_pais">
                    <option value="87" <?= ($isEdit && $cliente_edit['fk_id_pais'] == 87) ? 'selected' : '' ?>>El Salvador</option>
                    <option value="1" <?= ($isEdit && $cliente_edit['fk_id_pais'] == 1) ? 'selected' : '' ?>>Guatemala</option>
                    <option value="2" <?= ($isEdit && $cliente_edit['fk_id_pais'] == 2) ? 'selected' : '' ?>>Honduras</option>
                </select>
            </div>

            <div class="col-md-12 mb-3 campo-dinamico" id="col_descripcion">
                <label class="form-label text-muted small fw-bold mb-1">Descripción adicional</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="descripcion_adicional" id="descripcion_adicional" value="<?= $isEdit ? htmlspecialchars($cliente_edit['descripcion_adicional'] ?? '') : '' ?>">
            </div>

            <div class="col-md-6 mb-3 campo-dinamico" id="col_direccion">
                <label class="form-label text-muted small fw-bold mb-1">Dirección</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="direccion" id="direccion" value="<?= $isEdit ? htmlspecialchars($cliente_edit['direccion'] ?? '') : '' ?>">
            </div>

            <div class="col-md-6 mb-3 campo-dinamico" id="col_ciudad">
                <label class="form-label text-muted small fw-bold mb-1">Ciudad</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="ciudad" id="ciudad" value="<?= $isEdit ? htmlspecialchars($cliente_edit['ciudad'] ?? '') : '' ?>">
            </div>

            <div class="col-12 text-end mt-2">
                <button type="submit" class="btn <?= $isEdit ? 'btn-warning' : 'btn-success' ?> px-4 py-2 shadow-sm" style="border:none;">
                    <?= $isEdit ? '+ Actualizar ' : '+ Agregar' ?>
                </button>
            </div>
        </div>
    </form>
</div>