<?php
class CurrentActivities extends Controller {
    private $currentActModel;

    public function __construct() {
        checkRole('principal');
        // Load the currrentActModel
        $this->currentActModel = $this->model('CurrentActModel');
    }

    public function allFreeClasses() {
        // Fetch free classes from the model
        $freeClasses = $this->currentActModel->getFreeClasses();
        
        // Prepare data for the view
        $data = [
            'freeClasses' => []
        ];

        // Check if $freeClasses is an array and not false
        if (is_array($freeClasses) && !empty($freeClasses)) {
            $data['freeClasses'] = array_map(function ($class) {
                return [
                    'className' => $class->className,
                    'subjectName' => $class->subjectName,
                    'periodName' => $class->periodName,
                    'roomNumber' => $class->roomNumber,
                    'subjectId' => $class->subjectId,
                    'periodId' => $class->periodId,
                    'day' => $class->day
                ];
            }, $freeClasses);
        } else {
            // Optionally add a message to display in the view
            $data['message'] = 'No free classes found for today.';
        }

        // Pass the data to the view
        $this->view('inc/principal/viewCurrentActivities/allFreeClasses', $data);
    }

    public function showAvailableTeachers() {
        // Fetch parameters from $_GET
        $subjectId = isset($_GET['subjectId']) ? $_GET['subjectId'] : null;
        $periodId = isset($_GET['periodId']) ? $_GET['periodId'] : null;
        $day = isset($_GET['day']) ? $_GET['day'] : null;

        $availableTeachers = $this->currentActModel->getAvailableTeachers($subjectId, $periodId, $day);
        
        $data = [
            'availableTeachers' => []
        ];

        if (is_array($availableTeachers) && !empty($availableTeachers)) {
            $data['availableTeachers'] = $availableTeachers;
            $data['subjectId'] = $subjectId;
            $data['periodId'] = $periodId;
            $data['day'] = $day;
        } 
        else {
            $data['message'] = 'No available teachers found for this slot.';
        }      
        
        $this->view('inc/principal/viewCurrentActivities/allFreeTeachers', $data);
    }
}

?>