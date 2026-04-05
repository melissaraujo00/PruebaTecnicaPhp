<div class="bg-white p-4 shadow-sm mb-4">
    <div class="d-flex justify-content-between mb-3 text-muted align-items-center" style="font-size: 0.9rem;">
        <div>
            Mostrar 
            <select class="form-select form-select-sm d-inline-block mx-1 w-auto border-light shadow-sm">
                <option value="10">10</option>
                <option value="25">25</option>
            </select> registros
        </div>
        <div>
            Buscar: <input type="text" class="form-control form-control-sm d-inline-block ml-2 w-auto border-light shadow-sm">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table custom-data-table w-100">
            <thead>
                <tr>
                    <th>Razón Social <span class="sort-icon">&#8693;</span></th>
                    <th>Nombre Comercial <span class="sort-icon">&#8693;</span></th>
                    <th>Dirección <span class="sort-icon">&#8693;</span></th>
                    <th>N° Documento <span class="sort-icon">&#8693;</span></th>
                    <th>NRC <span class="sort-icon">&#8693;</span></th>
                    <th>Correo <span class="sort-icon">&#8693;</span></th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $index => $c): ?>
                <tr class="<?= $index % 2 != 0 ? 'striped-row' : '' ?>">
                    <td class="font-weight-medium text-dark"><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['nombre_comercial'] ?? '') ?></td>
                    <td><?= htmlspecialchars($c['direccion'] ?? '') ?></td>
                    <td><?= htmlspecialchars($c['dui_nit']) ?></td>
                    <td><?= htmlspecialchars($c['nrc'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($c['correo'] ?? '') ?></td>
                    <td class="text-center">
                        <a href="<?= APP_URL ?>/clientes/edit/<?= $c['id_catalogo_cliente'] ?>" class="text-primary text-decoration-none" title="Editar">&#9998;</a>
                        <a href="<?= APP_URL ?>/clientes/delete/<?= $c['id_catalogo_cliente'] ?>" class="text-danger text-decoration-none ms-2" title="Eliminar" onclick="return confirm('¿Eliminar?')">&#128465;</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>