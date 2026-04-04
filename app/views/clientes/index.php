<?php require_once APP_ROOT . '/Views/inc/header.php'; ?>

<div class="container bg-white p-4 shadow-sm rounded mt-4">

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-secondary mb-0" style="color: #7b8fa3 !important; font-weight: 500;"><?= $title ?></h2>
        <a href="<?= APP_URL ?>/clientes/create" class="btn btn-primary rounded text-white shadow-sm px-3 py-2" style="background-color: #0d6efd; border: none;">
            + Nuevo Cliente
        </a>
    </div>

    <div class="d-flex justify-content-between mb-3 text-muted align-items-center" style="font-size: 0.9rem;">
        <div>
            Mostrar 
            <select class="form-select form-select-sm d-inline-block mx-1 w-auto border-light shadow-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select> 
            registros
        </div>
        <div>
            Buscar: <input type="text" class="form-control form-control-sm d-inline-block ml-2 w-auto border-light shadow-sm">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-data-table w-100">
            <thead>
                <tr>
                    <th>ID <span class="sort-icon">&#8693;</span></th>
                    <th>Nombre <span class="sort-icon">&#8693;</span></th>
                    <th>DUI/NIT <span class="sort-icon">&#8693;</span></th>
                    <th>Tipo Documento <span class="sort-icon">&#8693;</span></th>
                    <th>Tipo Contribuyente <span class="sort-icon">&#8693;</span></th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $index => $c): ?>
                <tr class="<?= $index % 2 != 0 ? 'striped-row' : '' ?>">
                    <td class="font-weight-medium text-dark"><?= htmlspecialchars($c['id_catalogo_cliente']) ?></td>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['dui_nit']) ?></td>
                    <td><?= htmlspecialchars($c['tipo_documento'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($c['tipo_contribuyente'] ?? 'N/A') ?></td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="<?= APP_URL ?>/clientes/show/<?= $c['id_catalogo_cliente'] ?>" class="btn btn-sm btn-info text-white" title="Ver">&#128065;</a>
                            <a href="<?= APP_URL ?>/clientes/edit/<?= $c['id_catalogo_cliente'] ?>" class="btn btn-sm btn-warning text-white" title="Editar">&#9998;</a>
                            <a href="<?= APP_URL ?>/clientes/delete/<?= $c['id_catalogo_cliente'] ?>" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Eliminar este cliente?')">&#128465;</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once APP_ROOT . '/Views/inc/footer.php'; ?>