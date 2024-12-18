<?php 
class add_teacher_detailsModel{

    use Model;

    protected $table = 'teacher_details';
    protected $allowedColumns = [
        "regNo",
        "email",
        "mobileNo",
        "address",
        "username",
        "password",
        "dob",
        "gender",
        "religion",
        "role"
    ];

    protected $order_column = 'regNo'; // Defined here
}

