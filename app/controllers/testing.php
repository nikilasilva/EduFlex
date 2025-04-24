<!-- ask how to save 'Target Audience' -->


<?php
class ExtraEvent extends Controller
{
    private $extraEventModel;

    // public function __construct() {
    //     // Load the AnnouncementModel
    //     $this->extraEventModel = $this->model('extraEventModel');
    // }

    public function index()
    {
        // $this->view('inc/extra-events/createEvent');
    }

    public function autoAllocateCharacterCertificateTime($allocatedId, $studentId)
{
    $timeSlots = ['8:00 AM - 9:00 AM', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM'];
    $daysOfWeek = ['Monday', 'Friday'];

    $allocationModel = new character_allocated_timeModel();
    $allocatedSlots = $allocationModel->findAll();
    $slotCounts = [];

    foreach ($allocatedSlots as $allocation) {
        $key = $allocation->day . '|' . $allocation->time_slot;
        if (!isset($slotCounts[$key])) {
            $slotCounts[$key] = 0;
        }
        $slotCounts[$key]++;
    }

    $timeSlot = null;
    $dayDate = null;

    foreach ($daysOfWeek as $weekday) {
        $date = $this->getNextWeekdayDate($weekday); // Get upcoming Monday/Friday
        foreach ($timeSlots as $currentSlot) {
            $key = $date . '|' . $currentSlot;
            if (!isset($slotCounts[$key]) || $slotCounts[$key] < 2) {
                $timeSlot = $currentSlot;
                $dayDate = $date;
                break 2; // Exit both loops
            }
        }
    }

    // Fallback default values
    if (!$timeSlot || !$dayDate) {
        $dayDate = $this->getNextWeekdayDate('Monday');
        $timeSlot = $timeSlots[0];
    }

    // Save allocation
    $allocationModel->insert([
        'student_id' => $studentId,
        'certificate_id' => $allocatedId,
        'time_slot' => $timeSlot,
        'day' => $dayDate // This is now a valid DATE
    ]);
}



private function getNextWeekdayDate($weekday)
{
    // $today = new DateTime();
    $target = new DateTime("next $weekday");
    return $target->format('Y-m-d'); // MySQL DATE format
}



    // --------event funtino starrtt

    
}
