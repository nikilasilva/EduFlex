<?php

class createEvent
{
    use Model;

    protected $table = "Event";
    // protected $order_column = "EventID";
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
