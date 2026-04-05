<div class="bg-white p-4 shadow-sm mb-4 form-accent-container d-none" id="contenedorFormulario">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-secondary mb-0 fw-bold">Registrar Cliente</h5>
        <button type="button" class="btn-close" id="btnCerrarFormulario" aria-label="Cerrar"></button>
    </div>

    <form action="<?= APP_URL ?>/clientes/store" method="POST" id="formCrearCliente">
        
        <div class="row mb-4">
            <div class="col-md-12">
                <label class="form-label text-muted small fw-bold mb-1">Tipo de cliente</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none" name="tipo_cliente" id="tipo_cliente" required>
                    <option value="" selected disabled>Seleccione un tipo...</option>
                    <option value="1">Consumidor final</option>
                    <option value="2">Empresa / Crédito fiscal</option>
                    <option value="3">Extranjero</option>
                    <option value="4">Proveedor</option>
                </select>
            </div>
        </div>

        <div class="row d-none" id="camposRestantes">
            
            <div class="col-md-4 mb-3 campo-dinamico" id="col_documento">
                <label class="form-label text-muted small fw-bold mb-1">Documento</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_tipo_documento" id="cod_tipo_documento">
                    <option value="" selected>...</option>
                    <?php foreach($tiposDocumento as $doc): ?>
                        <option value="<?= $doc['id_tipo_documento'] ?>">
                            <?= htmlspecialchars($doc['tipo_documento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 mb-3 campo-dinamico" id="col_num_documento">
                <label class="form-label text-muted small fw-bold mb-1">N° Documento</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="dui_nit" id="dui_nit">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nrc">
                <label class="form-label text-muted small fw-bold mb-1">NRC / IVA</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nrc" id="nrc">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nombre">
                <label class="form-label text-muted small fw-bold mb-1">Razón social / Nombre del cliente</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nombre" id="nombre">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_nombre_comercial">
                <label class="form-label text-muted small fw-bold mb-1">Nombre comercial</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="nombre_comercial" id="nombre_comercial">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_telefono">
                <label class="form-label text-muted small fw-bold mb-1">Teléfono</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="telefono" id="telefono">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_correo">
                <label class="form-label text-muted small fw-bold mb-1">Correo</label>
                <input type="email" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="correo" id="correo">
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_giro">
                <label class="form-label text-muted small fw-bold mb-1">Giro</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_actividad_economica" id="cod_actividad_economica">
                    <option value="" selected>...</option>
                    <?php foreach($actividades as $act): ?>
                        <option value="<?= $act['id_actividad_economica'] ?>">
                            <?= htmlspecialchars($act['actividad_economica']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_tipo_contribuyente">
                <label class="form-label text-muted small fw-bold mb-1">Tipo contribuyente</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="fk_id_tipo_contribuyente" id="fk_id_tipo_contribuyente">
                    <option value="" selected>...</option>
                    <?php foreach($tiposContribuyente as $tc): ?>
                        <option value="<?= $tc['id_tipo_contribuyente'] ?>">
                            <?= htmlspecialchars($tc['tipo_contribuyente']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_tipo_persona">
                <label class="form-label text-muted small fw-bold mb-1">Tipo de persona</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="tipo_persona" id="tipo_persona">
                    <option value="1" selected>Natural</option>
                    <option value="2">Jurídica</option>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_departamento">
                <label class="form-label text-muted small fw-bold mb-1">Departamento</label>
                <select class="form-select input-dinamico" name="cod_departamento" id="cod_departamento">
                    <option value="" selected>Seleccione un departamento...</option>
                    <?php foreach($departamentos as $depto): ?>
                        <option value="<?= $depto['id_departamento'] ?>">
                            <?= htmlspecialchars($depto['departamento']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_municipio">
                <label class="form-label text-muted small fw-bold mb-1">Municipio</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="cod_municipio" id="cod_municipio">
                    <option value="" selected>Seleccione un departamento primero...</option>
                </select>
            </div>

            <div class="col-md-4 mb-3 campo-dinamico" id="col_pais">
                <label class="form-label text-muted small fw-bold mb-1">País</label>
                <select class="form-select form-select-sm border-light-subtle shadow-none input-dinamico" name="fk_id_pais" id="fk_id_pais">
                    <option value="87" selected>El Salvador</option>
                    <option value="1">Guatemala</option>
                    <option value="2">Honduras</option>
                </select>
            </div>

            <div class="col-md-12 mb-3 campo-dinamico" id="col_descripcion">
                <label class="form-label text-muted small fw-bold mb-1">Descripción adicional</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="descripcion_adicional" id="descripcion_adicional">
            </div>

            <div class="col-md-6 mb-3 campo-dinamico" id="col_direccion">
                <label class="form-label text-muted small fw-bold mb-1">Dirección</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="direccion" id="direccion">
            </div>

            <div class="col-md-6 mb-3 campo-dinamico" id="col_ciudad">
                <label class="form-label text-muted small fw-bold mb-1">Ciudad</label>
                <input type="text" class="form-control form-control-sm border-light-subtle shadow-none input-dinamico" name="ciudad" id="ciudad" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]+" title="Solo se permiten letras y espacios">>
            </div>

            <div class="col-12 text-end mt-2">
                <button type="submit" class="btn btn-success px-4 py-2 shadow-sm" style="background-color: #198754; border:none;">
                    + Agregar
                </button>
            </div>
        </div>
    </form>
</div>