
<?php
class viewModel{
     protected static function get_view($view){
        $white_list =["home","products","users","new-user","edit-user", "categories","new-categories","edit-categories","products","new-products","edit-products" ];  
        if (in_array($view,$white_list)) {  
            if (is_file("./view/".$view.".php")) {  

                $content ="./view/".$view.".php";
            }else{
                $content ="404"; 
            }
        }elseif($view == "login") { 
            $content ="login";
         }else {
            $content= "404"; 
        }
        return $content; 
     }
}

?>