<?php
class ExtraEvent extends Controller {
    private $extraEventModel;

    // public function __construct() {
    //     // Load the AnnouncementModel
    //     $this->extraEventModel = $this->model('extraEventModel');
    // }

    public function index() {
        $this->view('inc/extra-events/createEvent');
    }
}

?>