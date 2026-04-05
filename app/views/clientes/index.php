<?php require_once __DIR__ . '/../inc/header.php'; ?>

<div class="container mt-4">

    <?php render_component('alerts'); ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-secondary mb-0" style="color: #7b8fa3 !important; font-weight: 500;">
            <?= $title ?? 'Clientes' ?>
        </h2>
        <a href="#" id="btnNuevoCliente" class="btn btn-secondary rounded text-white shadow-sm px-3 py-2" style="background-color: #0d6efd; border: none;">
            + Nuevo Cliente
        </a>
    </div>



    <?php render_component('form_cliente', [
        'departamentos' => $departamentos,
        'actividades' => $actividades,
        'tiposContribuyente' => $tiposContribuyente,
        'tiposDocumento' => $tiposDocumento,
        'municipios' => $municipios,
        'cliente_edit' => $cliente_edit ?? null
    ]); ?>

    <?php render_component('table_clientes', [
        'clientes' => $clientes 
    ]); ?>

</div>
<script>
    const todosLosMunicipios = <?= json_encode($municipios) ?>;
</script>
<?php require_once __DIR__ . '/../inc/footer.php'; ?>