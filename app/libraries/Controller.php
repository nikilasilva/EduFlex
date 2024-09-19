<?php
// URL format -> /controller/method/params
    class Controller {
        // to load the model
        public function model($model) {
            require_once '../app/models'.$model.'.php';

            // instatntiate the model and pass it to the controller.
            return new $model();
        }

        // to load the view
        public function view($view, $data = []) {
            if (file_exists('../app/views/'.$view.'.php')) {
                require_once '../app/views/'.$view.'.php';
            }
            else {
                die('Corresponding view does not exist!');
            }
        }
    }
?>
