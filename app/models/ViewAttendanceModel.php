<?php

class ViewAttendanceModel {
    use Database;

    protected $table = 'student_attendance';
    protected $allowedColumns = [
        'student_id',
        'date',
        'status'
    ];

    // Get attendance records for a student based on a specific month and year
    public function getAttendanceByMonthYear($studentId, $month, $year) {
        // Generate the start and end date for the given month and year
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));  // Get last date of the month

        // SQL query to fetch attendance for the specific student and month/year range
        $query = "SELECT date, status FROM student_attendance 
                  WHERE student_id = :studentId 
                  AND date BETWEEN :startDate AND :endDate 
                  ORDER BY date ASC";

        // Execute the query and return the results
        return $this->query($query, [
            'studentId' => $studentId,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
