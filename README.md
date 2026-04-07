# Sistema de Gestion de Clientes - Arquitectura MVC

Este repositorio contiene un sistema de gestion de clientes (CRUD completo) desarrollado en PHP puro implementando el patron de diseno Modelo-Vista-Controlador (MVC). El sistema esta diseñado para manejar diferentes tipos de clientes y aplicar reglas de negocio dinamicas en tiempo real.


## Tecnologias Utilizadas

* Backend: PHP 8.0
* Base de Datos: MySQL 
* Frontend: HTML5, CSS3, Bootstrap (para estilos y grid system)
* Logica de Interfaz: JavaScript 
## Instalacion y Configuracion

1. Clonar el repositorio en el directorio raiz de tu servidor web (htdocs o www):
   git clone https://github.com/melissaraujo00/nombre-del-repo.git

2. Importar la base de datos:
   * Importa el archivo de volcado SQL provisto en la entrevista 

3. Configurar variables de entorno:
   * Renombra el archivo de configuracion de ejemplo (si aplica) o edita la clase principal para ajustar los credenciales de conexion a la base de datos (DB_HOST, DB_USER, DB_PASS, DB_NAME).
   * Asegurate de que la constante APP_URL apunte a la ruta correcta de tu servidor local.

## Estructura del Proyecto

El codigo sigue una estructura de directorios estandar para el patron MVC:

/app
  /Controllers   # Logica de intermediacion y peticiones HTTP
  /Core          # Clases base del framework (App, Controller, Model)
  /helpers       # Clases de apoyo como Validadores y renderizadores de vistas
  /Models        # Consultas SQL y metodos de base de datos
  /Views         # Archivos HTML/PHP de presentacion agrupados por modulo
/public
  /css           # Hojas de estilo personalizadas
  /js            # Scripts de interaccion dinamica del lado del cliente
index.php        # Punto de entrada de la aplicacion (Front Controller)
.htaccess        # Reglas de reescritura de URLs
