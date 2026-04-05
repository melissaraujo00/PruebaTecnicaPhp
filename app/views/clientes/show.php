<?php require_once APP_ROOT . '/Views/inc/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary mb-0 fw-bold"><?= $title ?></h2>
        <a href="<?= APP_URL ?>/clientes" class="btn btn-outline-secondary btn-sm">
            &larr; Volver a la lista
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light border-bottom-0 pt-4 pb-0 px-4">
            <h4 class="text-primary mb-0">
                <i class="fas fa-user-circle me-2"></i> 
                <?= htmlspecialchars($cliente['nombre']) ?>
            </h4>
            <p class="text-muted small mt-1">
                Registrado el: <?= date('d/m/Y g:i A', strtotime($cliente['created_at'])) ?>
            </p>
        </div>
        
        <div class="card-body px-4 pb-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-uppercase text-muted fw-bold small border-bottom pb-2">Información Fiscal</h6>
                    
                    <p class="mb-1"><strong>Tipo de Cliente:</strong> 
                        <?php 
                            $tipos = [1 => 'Consumidor Final', 2 => 'Crédito Fiscal', 3 => 'Extranjero', 4 => 'Proveedor'];
                            echo $tipos[$cliente['tipo_cliente']] ?? 'Desconocido';
                        ?>
                    </p>
                    <p class="mb-1"><strong>Documento (<?= htmlspecialchars($cliente['nombre_documento'] ?? 'N/A') ?>):</strong> <?= htmlspecialchars($cliente['dui_nit']) ?></p>
                    
                    <?php if(!empty($cliente['nrc'])): ?>
                        <p class="mb-1"><strong>NRC:</strong> <?= htmlspecialchars($cliente['nrc']) ?></p>
                    <?php endif; ?>
                    
                    <?php if(!empty($cliente['nombre_contribuyente'])): ?>
                        <p class="mb-1"><strong>Contribuyente:</strong> <?= htmlspecialchars($cliente['nombre_contribuyente']) ?></p>
                    <?php endif; ?>
                    
                    <?php if(!empty($cliente['nombre_giro'])): ?>
                        <p class="mb-1"><strong>Giro:</strong> <?= htmlspecialchars($cliente['nombre_giro']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <h6 class="text-uppercase text-muted fw-bold small border-bottom pb-2">Contacto y Ubicación</h6>
                    
                    <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($cliente['telefono'] ?: 'No registrado') ?></p>
                    <p class="mb-1"><strong>Correo:</strong> <?= htmlspecialchars($cliente['correo'] ?: 'No registrado') ?></p>
                    
                    <?php if(!empty($cliente['nombre_departamento'])): ?>
                        <p class="mb-1"><strong>Ubicación:</strong> 
                            <?= htmlspecialchars($cliente['nombre_municipio'] ?? '') ?>, 
                            <?= htmlspecialchars($cliente['nombre_departamento']) ?>
                        </p>
                    <?php endif; ?>

                    <p class="mb-1"><strong>Dirección:</strong> <?= htmlspecialchars($cliente['direccion'] ?: 'No registrada') ?></p>
                </div>
            </div>
            
            <div class="mt-4 text-end">
                <a href="<?= APP_URL ?>/clientes/edit?id=<?= $cliente['id_catalogo_cliente'] ?>" class="btn btn-primary shadow-sm">
                    <i class="fas fa-edit me-1"></i> Editar Cliente
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_ROOT . '/Views/inc/footer.php'; ?>