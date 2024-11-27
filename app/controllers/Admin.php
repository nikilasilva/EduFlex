<?php
    class Admin extends Controller {
        public function __construct() {
        }

        /* ******************* */
        public function manageuser(){
            $this->view('inc/admin/user_registration_by_admin');
        }
        /* view user details */
        public function viewuser(){
            $this->view('inc/admin/user_recode_view_by_admin'); 
        }

        // Manage students
        public function managestudent(){
            $this->view('inc/admin/manage_student_by_admin');
        }
                // Insert Student details
                public function insertstudent(){
                    $this->view('inc/admin/add_student_by_admin');
                }


         // Manage parents
         public function manageparent(){
            $this->view('inc/admin/manage_parents_by_admin');
        }

               // Insert Parents details
            public function insertparent(){
                $this->view('inc/admin/add_parents_by_admin');
                }   

        // Manage teacher
        public function manageteacher(){
            $this->view('inc/admin/manage_teacher_by_admin');
        }

                   // Insert Teacher details
            public function insertteacher(){
                $this->view('inc/admin/add_parents_by_admin');
                }

         // Manage principal
         public function manageprincipal(){
            $this->view('inc/admin/manage_principal_by_admin');
        }

         // Manage viceprincipal
         public function manageviceprincipal(){
            $this->view('inc/admin/manage_viceprincipal_by_admin');
        }

        // Manage non-academic
        public function managenonaca(){
            $this->view('inc/admin/manage_nonaca_by_admin');
        }
        
           // Manage non-academic
           public function manageMIS(){
            $this->view('inc/admin/manage_MIS_by_admin');
        }

            // Manage class-room
            public function manageclassroom(){
                $this->view('inc/admin/manage_classroom_by_admin');
            }

            // Manage Time table
            public function managetimetable(){
                $this->view('inc/admin/manage_timetable_by_admin');
            }
        
            

    }
?>