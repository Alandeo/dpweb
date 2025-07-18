    <?php                                              // Este archivo se encarga de decidir qué vista debe mostrar el sistema (como productos, usuarios, login, et).
    require_once "./model/views_model.php";            // Importa el archivo del modelo de vistas

    class viewsControl extends viewModel               // Esta clase hereda de viewModel, es decir, puede usar sus funciones, como get_view.
    {
        public function getPlantillaControl()          // Función para obtener la plantilla principal del sistema
        {
            return require_once "./view/plantilla.php"; // Retorna e incluye el archivo plantilla.php (estructura base)
        }

        public function getViewControl()               // Función que decide qué vista mostrar al usuario
        {
            session_start();                           // Inicia la sesión para acceder a las variables $_SESSION

            if (isset($_SESSION['ventas_id'])) {       // Si el usuario ha iniciado sesión (variable de sesión existe)

                if (isset($_GET["views"])) {           // Verifica si hay una vista solicitada en la URL (por ejemplo, ?views=productos)
                    $ruta = explode("/", $_GET["views"]); // Divide el valor de views por "/" (por si hay subrutas)
                    $response = viewModel::get_view($ruta[0]); // Llama al modelo para obtener la vista correspondiente
                } else {
                    $response = "index.php";           // Si no se especificó vista, carga la página principal
                }

            } else {
                $response = "login";                   // Si no hay sesión iniciada, envía al usuario al login
            }

            return $response;                          // Devuelve el nombre del archivo que se debe cargar
        }
    }
