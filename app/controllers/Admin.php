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

/* For Student */
        // Manage students

/* #        public function managestudent(){
            $this->view('inc/admin/manage_student_by_admin');
        }
                // Insert Student details
                public function insertstudent(){
                    $this->view('inc/admin/add_student_by_admin');
                }
                # */

/* For Parent */

         // Manage parents
 /* #        public function manageparent(){
            $this->view('inc/admin/manage_parents_by_admin');
        }

               // Insert Parents details
            public function insertparent(){
                $this->view('inc/admin/add_parents_by_admin');
                }   

                # */
/* For Teacher */
        // Manage teacher
    /*    public function manageteacher(){
            $this->view('inc/admin/manage_teacher_by_admin');
        }

                   // Insert Teacher details
            public function insertteacher(){
                $this->view('inc/admin/add_teacher_by_admin');
                }
                #*/
/* For Principal */
         // Manage principal
   /*##      public function manageprincipal(){
            $this->view('inc/admin/manage_principal_by_admin');
        }
             // Insert principal details
             public function insertprincipal(){
                $this->view('inc/admin/add_principal_by_admin');
                }
                    #*/
/* For vice principal */                
         // Manage vice_principal
    /*##     public function manageviceprincipal(){
            $this->view('inc/admin/manage_viceprincipal_by_admin');
        }
             // Insert vice_principal details
             public function insert_vice_principal(){
                $this->view('inc/admin/add_viceprincipal_by_admin');
                }
                ## */

/* For non-academic */
        // Manage non-academic
   /*#     public function manage_nonaca(){
            $this->view('inc/admin/manage_nonaca_by_admin');
        }
             // Insert Non-academic details
             public function insert_nonaca(){
                $this->view('inc/admin/add_nonaca_by_admin');
                }
                ##*/
/* For MIS */        
        // manage MIS
       public function manage_MIS(){
            $this->view('inc/admin/manage_MIS_by_admin');
        }
            // Insert MIS details
            public function insert_MIS(){
                $this->view('inc/admin/add_MIS_by_admin');
                }
                

/* For class-rooms */
        // Manage class-room
        public function manage_classroom(){
            $this->view('inc/admin/manage_classroom_by_admin');
            }

             // Insert class_room details
             public function inser_class_room(){
                $this->view('inc/admin/add_class_by_admin');
                }
            
/* For Time-table */
        // Manage Time table
        public function manage_timetable(){
            $this->view('inc/admin/manage_timetable_by_admin');
            }

            // Insert  academictime table
            public function insert_aca_time_table(){
                $this->view('inc/admin/add_aca_ttable_by_admin');
                }

                // Insert class_room details
          //  public function insert_aca_time_table(){
              //  $this->view('inc/admin/add_aca_ttable_by_admin');
                //}

        
            

    }
?>