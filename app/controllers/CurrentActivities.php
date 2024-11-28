<?php
class CurrentActivities extends Controller {
    private $currrentActModel;

    // public function __construct() {
    //     // Load the currrentActModel
    //     $this->currrentActModel = $this->model('currrentActModel');
    // }

    public function allFreeClasses() {
        $this->view('inc/principal/viewCurrentActivities/allFreeClasses');
    }

    public function allFreeTeachers() {
        $this->view('inc/principal/viewCurrentActivities/allFreeTeachers');
    }
}

?>