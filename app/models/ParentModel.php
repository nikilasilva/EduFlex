<?php
class ParentModel {
    use Model;

    protected $table = 'parents';
    protected $allowedColumns = [
        'regNo',
        'firstName',
        'lastName',
        'occupation',
        'relationship'
    ];

    protected $order_column = 'regNo';

    public function insertParent($data) {
        return $this->insert($data);
    }

    public function regNoExists($regNo) {
        return $this->first(['regNo' => $regNo]) !== false;
    }

    public $errors = [];

    public function validate($data) {
        $this->errors = [];

        // regNo validation
        if (empty($data['regNo']) || !is_numeric($data['regNo']) || $data['regNo'] <= 0) {
            $this->errors['regNo'] = 'A valid registration number is required.';
        }

        // // firstName validation
        // if (empty($data['firstName'])) {
        //     $this->errors['firstName'] = 'First name is required.';
        // }

        // occupation validation
        if (empty($data['occupation'])) {
            $this->errors['occupation'] = 'Occupation is required.';
        }

        // relationship validation
        if (empty($data['relationship']) || !in_array($data['relationship'], ['father', 'mother', 'guardian'])) {
            $this->errors['relationship'] = 'Relationship must be father, mother, or guardian.';
        }

        return empty($this->errors);
    }
}

?>