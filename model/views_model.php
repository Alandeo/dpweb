
<?php
class viewModel{
     protected static function get_view($view){
        $white_list =["home","products","users","new-user", "categories"];  /* Son los únicos nombres de vistas que el sistema acepta mostrar. */
        if (in_array($view,$white_list)) {  /*"¿Lo que llegó en $view está en la lista blanca?" */
            if (is_file("./view/".$view.".php")) {  /*Revisa si existe el archivo PHP dentro de la carpeta /view/.
Por ejemplo: si $view = "products", busca el archivo view/products.php. */
                $content ="./view/".$view.".php";
            }else{
                $content ="404"; /* Si el archivo no existe, devuelve "404", lo que significa error o página no encontrada. */
            }
        }elseif($view == "login") { /* Si el valor recibido en $view es "login", muestra la página del login */
            $content ="login";
         }else {
            $content= "404"; /*Si el nombre recibido no está en la lista blanca ni es login, entonces también devuelve "404".*/
        }
        return $content; /*Devuelve la ruta del archivo que se debe cargar. */
     }
}
/*Sirve para decidir qué archivo (vista) debe mostrar el sistema al usuario. */
?>