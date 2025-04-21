<?php

class createEvent
{
    use Model;

    protected $table = "Event";
    protected $order_column = "EventStartDateTime"; // Add this line!

    protected $allowedColumns = [
        "EventID",
        "EventName",
        "EventStartDateTime",
        "EventType",
        "Venue",
        "TargetAudienceStudents",
        "TargetAudienceTeachers",
        "TargetAudienceParents",
        "TargetAudienceNonAcademicStaff",
        "Description",
        "EventCoordinators"
    ];
}
