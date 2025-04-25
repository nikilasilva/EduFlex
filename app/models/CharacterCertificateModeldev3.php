<?php
class CharacterCertificateModeldev3 {
    use Model;

    protected $table = 'character_certificates';
    protected $allowedColumns = [
        'certificate_id',
        'full_name',
        'student_id',
        'date_of_birth',
        'guardian_name',
        'address',
        'slip',
        'status'
    ];
    protected $order_column = 'certificate_id';

}