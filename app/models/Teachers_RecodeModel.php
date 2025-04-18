<?php

class Teachers_RecodeModel {
    use Model; //  Correct usage of a trait

    public function __construct() {
        $this->db = new Database(); // If needed, based on trait functionality
    }

    // rest of your methods...
}

