<?php
    class Core {
        // URL format -> /controller/method/params
        protected $currentController = 'Dashboard';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getURL();
        
            // Check if a valid controller exists
            if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            } else {
                $this->show404();
                return;
            }
        
            // Require and instantiate the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;
        
            // Check if a valid method exists in the controller
            if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            } elseif(!isset($url[1]) || $url[1] !== '') {
                // Fallback to the default method
                // $this->currentMethod = 'index';
                $this->show404();
                return;
            }
        
            // Get the parameters
            $this->params = $url ? array_values($url) : [];
        
            // Call the method with parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }
        

        public function getURL() {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }

        private function show404() {
            // Include a 404 error page
            require_once '../app/views/inc/ErrorPages/404.php';
            exit; // Stop further execution
        }
    }
?>