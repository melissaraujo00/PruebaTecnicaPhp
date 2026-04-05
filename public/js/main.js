document.addEventListener("DOMContentLoaded", function() {
    
    const btnNuevoCliente = document.getElementById('btnNuevoCliente');
    const contenedorFormulario = document.getElementById('contenedorFormulario');
    const btnCerrarFormulario = document.getElementById('btnCerrarFormulario');
    const formCrearCliente = document.getElementById('formCrearCliente');
    
    if (btnNuevoCliente && contenedorFormulario) {
        
        const selectTipoCliente = document.getElementById('tipo_cliente');
        const camposRestantes = document.getElementById('camposRestantes');
        const todosLosCamposDinamicos = document.querySelectorAll('.campo-dinamico');

        const configCampos = {
            "1": { 
                mostrar: ['col_documento', 'col_num_documento', 'col_nombre', 'col_nombre_comercial', 'col_correo', 'col_direccion'],
                requeridos: ['cod_tipo_documento', 'dui_nit', 'nombre']
            },
            "2": {
                mostrar: ['col_documento', 'col_num_documento', 'col_nrc', 'col_nombre', 'col_nombre_comercial', 'col_telefono', 'col_correo', 'col_giro', 'col_tipo_contribuyente', 'col_tipo_persona', 'col_departamento', 'col_municipio', 'col_descripcion', 'col_direccion', 'col_ciudad'],
                requeridos: ['cod_tipo_documento', 'dui_nit', 'nrc', 'nombre']
            },
            "3": { 
                mostrar: ['col_documento', 'col_num_documento', 'col_nombre', 'col_nombre_comercial', 'col_telefono', 'col_correo', 'col_pais', 'col_descripcion', 'col_direccion', 'col_ciudad'],
                requeridos: ['cod_tipo_documento', 'dui_nit', 'nombre', 'fk_id_pais']
            },
            "4": { 
                mostrar: ['col_documento', 'col_num_documento', 'col_nombre', 'col_telefono', 'col_correo', 'col_departamento', 'col_municipio', 'col_descripcion', 'col_direccion', 'col_ciudad'],
                requeridos: ['cod_tipo_documento', 'dui_nit', 'nombre']
            }
        };

        btnNuevoCliente.addEventListener('click', function(e) {
            e.preventDefault();
            contenedorFormulario.classList.remove('d-none');
        });


        if (btnCerrarFormulario) {
            btnCerrarFormulario.addEventListener('click', function() {
                contenedorFormulario.classList.add('d-none');
                camposRestantes.classList.add('d-none');
                formCrearCliente.reset();
            });
        }

        selectTipoCliente.addEventListener('change', function() {
            const tipo = this.value;
            const config = configCampos[tipo];

            if (!config) return;

            camposRestantes.classList.remove('d-none');

            todosLosCamposDinamicos.forEach(columna => {
                const inputElement = columna.querySelector('.input-dinamico');

                if (config.mostrar.includes(columna.id)) {
                    columna.classList.remove('d-none');       
                    
                    if(inputElement) {
                        inputElement.disabled = false;       
                        
                        if (config.requeridos.includes(inputElement.id)) {
                            inputElement.required = true;
                        } else {
                            inputElement.required = false;
                        }
                    }
                } else {
                    columna.classList.add('d-none');
                    
                    if(inputElement) {
                        inputElement.disabled = true;         
                        inputElement.required = false;
                        
                    }
                }
            });

            const selectDoc = document.getElementById('cod_tipo_documento');
            if(tipo === "1" && selectDoc) selectDoc.value = "2"; 
            if(tipo === "2" && selectDoc) selectDoc.value = "1"; 
            if(tipo === "3" && selectDoc) selectDoc.value = "3"; 
        });

        if (selectTipoCliente && selectTipoCliente.value !== "") {
            selectTipoCliente.dispatchEvent(new Event('change'));
        }
    }

    

    const selectDepartamento = document.getElementById('cod_departamento');
    const selectMunicipio = document.getElementById('cod_municipio');

    if (selectDepartamento && selectMunicipio && typeof todosLosMunicipios !== 'undefined') {
        
        selectDepartamento.addEventListener('change', function() {
            const idDepartamento = this.value;
            

            selectMunicipio.innerHTML = '<option value="" selected>Seleccione un municipio...</option>';

            if (idDepartamento) {

                const municipiosFiltrados = todosLosMunicipios.filter(mun => mun.cod_mh_departamento == idDepartamento);

                municipiosFiltrados.forEach(mun => {
                    const option = document.createElement('option');
                    option.value = mun.id_municipio;
                    option.textContent = mun.municipio;
                    selectMunicipio.appendChild(option);
                });
                
  
                selectMunicipio.disabled = false;
            } else {
                selectMunicipio.disabled = true;
            }
        });
    }
});