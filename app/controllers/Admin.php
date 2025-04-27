<?php

class Admin extends Controller
{
    //private $TeacherModel;
        public function __construct() {}
            // Load necessary models (if required)
        // $this->teacherModel = $this->model('TeacherModel');

        
        // Manage Useraccount
    public function manage_useraccount(){
            $this->view('inc/admin/manage_useraccount');
        }
    // Submit User Details
    public function submitUser() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            // Collect and sanitize data
            $userData = [
                'fullName' => trim($_POST['fullName']),
                'nameWithInitial' => trim($_POST['nameWithInitial']),
                'email' => trim($_POST['email']),
                'mobileNo' => trim($_POST['mobileNo']),
                'address' => trim($_POST['address']),
                'password' => trim($_POST['password']),
                'dob' => trim($_POST['dob']),
                'gender' => trim($_POST['gender']),
                'religion' => trim($_POST['religion']),
                'role' => trim($_POST['role'])
            ];

            // Validation: Initialize error messages
            $errors = [];

            // Check each field
            if (empty($userData['fullName'])) {
                $errors['fullName'] = "Full Name is required.";
            }
            if (empty($userData['nameWithInitial'])) {
                $errors['nameWithInitial'] = "Name With Initials is required.";
            }
            if (empty($userData['email'])) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
            if (empty($userData['mobileNo'])) {
                $errors['mobileNo'] = "Mobile Number is required.";
            }
            if (empty($userData['address'])) {
                $errors['address'] = "Address is required.";
            }
            if (empty($userData['password'])) {
                $errors['password'] = "Password is required.";
            }
            if (empty($userData['dob'])) {
                $errors['dob'] = "Date of Birth is required.";
            }
            if (empty($userData['gender'])) {
                $errors['gender'] = "Gender is required.";
            }
            if (empty($userData['religion'])) {
                $errors['religion'] = "Religion is required.";
            }
            if (empty($userData['role'])) {
                $errors['role'] = "Role is required.";
            }

            // If there are errors, reload the form with error messages
            if (!empty($errors)) {
                $data = [
                    'userData' => $userData,
                    'errors' => $errors
                ];
                $this->view('inc/admin/manage_useraccount', $data);
                return;
            }

            // No errors -> continue to insert
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

            $userModel = new manage_useraccountModel();
            $reg_No = $userModel->insert($userData);

            // Redirect based on role
            switch ($userData['role']) {
                case 'parent':
                    header("Location: " . URLROOT . "/admin/manage_parent?regNo=" . $reg_No);
                    break;
                case 'student':
                    header("Location: " . URLROOT . "/admin/manage_student?regNo=" . $reg_No);
                    break;
                case 'teacher':
                    header("Location: " . URLROOT . "/admin/manage_teacher?regNo=" . $reg_No);
                    break;
                case 'principal':
                    header("Location: " . URLROOT . "/admin/manage_principal?regNo=" . $reg_No);
                    break;
                case 'vice-principal':
                    header("Location: " . URLROOT . "/admin/manage_vice_principal?regNo=" . $reg_No);
                    break;
                case 'non-academic':
                    header("Location: " . URLROOT . "/admin/manage_nonaca?regNo=" . $reg_No);
                    break;
                default:
                    header("Location: " . URLROOT . "/admin/viewUser");
                    break;
            }
            exit();
        } else {
            // GET Request
            $this->view('inc/admin/manage_useraccount');
        }
    }



    //View User Details
    public function viewUser() {
        $userModel = new manage_useraccountModel();
        $users = $userModel->findAll();

        $this->view('inc/Admin/Show_useraccount', ['users' => $users]);
    }

    // Edit User Details
    public function editUser($regNo) {
        $userModel = new manage_useraccountModel();
    
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Initialize data
            $data = [
                'fullName' => trim($_POST['fullName']),
                'nameWithInitial' => trim($_POST['nameWithInitial']),
                'email' => trim($_POST['email']),
                'mobileNo' => trim($_POST['mobileNo']),
                'address' => trim($_POST['address']),
                'dob' => $_POST['dob'],
                'gender' => $_POST['gender'],
                'religion' => trim($_POST['religion']),
                'role' => $_POST['role'],
                'fullName_err' => '',
                'nameWithInitial_err' => '',
                'email_err' => '',
                'mobileNo_err' => '',
                'address_err' => '',
                'dob_err' => '',
                'gender_err' => '',
                'religion_err' => '',
                'role_err' => ''
            ];
    
            // Validate Full Name
            if (empty($data['fullName'])) {
                $data['fullName_err'] = 'Please enter the full name.';
            }
    
            // Validate Name with Initials
            if (empty($data['nameWithInitial'])) {
                $data['nameWithInitial_err'] = 'Please enter name with initials.';
            }
    
            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format.';
            }
    
            // Validate Mobile Number
            if (empty($data['mobileNo'])) {
                $data['mobileNo_err'] = 'Please enter a mobile number.';
            } elseif (!preg_match('/^[0-9]{10}$/', $data['mobileNo'])) {
                $data['mobileNo_err'] = 'Mobile number must be 10 digits.';
            }
    
            // Validate Address
            if (empty($data['address'])) {
                $data['address_err'] = 'Please enter an address.';
            }
    
            // Validate Date of Birth
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Please select a date of birth.';
            }
    
            // Validate Gender
            if (empty($data['gender'])) {
                $data['gender_err'] = 'Please select a gender.';
            }
    
            // Validate Religion
            if (empty($data['religion'])) {
                $data['religion_err'] = 'Please enter religion.';
            }
    
            // Validate Role
            if (empty($data['role'])) {
                $data['role_err'] = 'Please select a role.';
            }
    
            // Check if there are no errors
            if (
                empty($data['fullName_err']) &&
                empty($data['nameWithInitial_err']) &&
                empty($data['email_err']) &&
                empty($data['mobileNo_err']) &&
                empty($data['address_err']) &&
                empty($data['dob_err']) &&
                empty($data['gender_err']) &&
                empty($data['religion_err']) &&
                empty($data['role_err'])
            ) {
                // No errors - Update user
                $updateData = [
                    'fullName' => $data['fullName'],
                    'nameWithInitial' => $data['nameWithInitial'],
                    'email' => $data['email'],
                    'mobileNo' => $data['mobileNo'],
                    'address' => $data['address'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'religion' => $data['religion'],
                    'role' => $data['role']
                ];
    
                $userModel->update($regNo, $updateData, 'regNo');
    
                // Redirect to view users page
                header("Location: " . URLROOT . "/admin/viewUser");
                exit();
            } else {
                // Load view with errors
                $this->view('inc/admin/edit_user_by_admin', ['users' => (object)$data]);
            }
        } else {
            // If GET request
            $users = $userModel->first(['regNo' => $regNo]);
    
            if ($users) {
                $this->view('inc/admin/edit_user_by_admin', ['users' => $users]);
            } else {
                die('User not found.');
            }
        }
    }
    

 
    // Delete User Details
    public function deleteUser($regNo) {
        $userModel = new manage_useraccountModel();
        $backupModel = new backupusersModel(); // <-- Use model, not new Database()

        // 1. First, fetch user data
        $userData = $userModel->first(['regNo' => $regNo]);

        if ($userData) {
            // 2. Insert the user data into backupusers table
            $backupData = [
                'regNo' => $userData->regNo,
                'email' => $userData->email,
                'mobileNo' => $userData->mobileNo,
                'address' => $userData->address,
                'fullName' => $userData->fullName,
                'nameWithInitial' => $userData->nameWithInitial,
                'password' => $userData->password,
                'dob' => $userData->dob,
                'gender' => $userData->gender,
                'religion' => $userData->religion,
                'role' => $userData->role
            ];

            $backupModel->insert($backupData);

            // 3. Now delete from users table
            $userModel->delete($regNo, 'regNo');
        }

        // Redirect to view users page
        header("Location: " . URLROOT . "/admin/viewUser");
        exit();
    }




    /* *Manage students* */
    /* *Manage students* */
    public function manage_student()
    {
        $userModel = new manage_useraccountModel();
        $users = $userModel->findAll();

        $classModel = new manage_classModel();
        $classes = $classModel->findAll();

        $this->view('inc/admin/manage_student', [
            'users' => $users,
            'classes' => $classes
        ]);
    }

    //For submit Student details
    

    // Insert Student
    public function submitStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentModel = new manage_studentModel();
            $classModel = new manage_classModel(); // assuming you have class model to get classes
            $userModel = new manage_useraccountModel(); // to get users for the table
    
            $data = [
                'regNo' => trim($_POST['regNo']),
                'classId' => trim($_POST['classId']),
                'form_err' => ''
            ];
    
            // Validation
            if (empty($data['regNo']) || empty($data['classId'])) {
                $data['form_err'] = "Please fill in all required fields.";
            }
    
            if (empty($data['form_err'])) {
                // No errors - insert the student
                $newStudentId = $studentModel->generateStudentID();
    
                $studentData = [
                    'student_id' => $newStudentId,
                    'regNo' => $data['regNo'],
                    'classId' => $data['classId']
                ];
    
                $studentModel->insert($studentData);
    
                header("Location: " . URLROOT . "/Admin/viewStudent");
                exit();
            } else {
                // Load data again for dropdown and table
                $data['classes'] = $classModel->findAll(); 
                $data['users'] = $userModel->findAll(); 
    
                // Return to form with error
                $this->view('inc/admin/manage_student', $data);
            }
        } else {
            // If GET, just reload the form
            $classModel = new manage_classModel();
            $userModel = new manage_useraccountModel();
    
            $data = [
                'classes' => $classModel->findAll(),
                'users' => $userModel->findAll()
            ];
    
            $this->view('inc/admin/manage_student', $data);
        }
    }
    


    // View Students
    public function viewStudent()
    {
        $studentModel = new manage_studentModel();
        $students = $studentModel->findAllWithUserInfo();

        $classModel = new manage_classModel();
        $classes = $classModel->findAll();

        $this->view('inc/Admin/Show_student', ['students' => $students]);
    }

    // Edit Student
    public function editStudent($regNo)
    {
        $studentModel = new manage_studentModel();
        $userModel = new manage_useraccountModel();
        $classModel = new manage_classModel();
        $classes = $classModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentData = [
                'student_id' => $_POST['student_id'],
                'regNo' => $_POST['regNo'],
                'classId' => $_POST['classId']
            ];

            $userData = [
                'fullName' => $_POST['fullName'],
                'nameWithInitial' => $_POST['nameWithInitial'],
                'mobileNo' => $_POST['mobileNo'],
                'address' => $_POST['address']
            ];

            $studentModel->update($regNo, $studentData, 'regNo');
            $userModel->updateUserNameDetails($regNo, $userData);

            header("Location: " . URLROOT . "/Admin/viewStudent");
            exit();
        } else {
            $student = $studentModel->first(['regNo' => $regNo]);
            $user = $userModel->first(['regNo' => $regNo]);

            if ($student && $user) {
                $this->view('inc/Admin/edit_student_by_admin', [
                    'student' => $student,
                    'user' => $user,
                    'classes' => $classes
                ]);
            } else {
                die('Student not found.');
            }
        }
    }


    // Delete Student
    public function deleteStudent($student_id)
    {
        $studentModel = new manage_studentModel();
        $studentModel->delete($student_id, 'student_id');

        header("Location: " . URLROOT . "/Admin/viewStudent");
        exit();
    }



        /* For Parent */
        // Manage parents
        public function Manage_parent(){

            $userModel = new manage_useraccountModel();
            $users = $userModel->findAll();

            $this->view('inc/admin/manage_parent',['users' => $users]);
        }
    //for submit parents details
        public function submitParent(){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $parentData = [
                    'NIC' => trim($_POST['NIC']),
                    'regNo' => trim($_POST['regNo']),
                    'firstName' => trim($_POST['firstName']),
                    'lastName' => trim($_POST['lastName']),
                    'Relationship' => trim($_POST['Relationship'])
                ];
                $parent = new manage_parentModel();
                $parent ->insert($parentData);
                // Here, save the parents to the database.

                // Display a success message or redirect to a success page
                header("Location: " . URLROOT . "/Admin/viewParent");
                exit();
            } else{
                // If not a POST request, reload the manage parent page
                $this->view('Manage_parent');
            }
        }
    //view Parent details
        public function viewParent(){
            $parentModel = new manage_parentModel();
            $parents = $parentModel->findAllWithUserInfo();


            // $nonacaModel = new manage_nonacaModel();
            // $nonacas = $nonacaModel->findAllWithUserInfo();

            $this->view('inc/Admin/Show_parent', ['parents' => $parents]);
        }

    // edit Parent details 
    public function editParent($regNo)
    {
        $parentModel = new manage_parentModel();
        $userModel = new manage_useraccountModel(); // include user model

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'NIC' => trim($_POST['NIC']),
                'regNo' => trim($_POST['regNo']),
                'Relationship' => trim($_POST['Relationship']),
                'fullName' => trim($_POST['fullName']),
                'nameWithInitial' => trim($_POST['nameWithInitial']),
            ];

            // Update the parents table
            $parentModel->update($regNo, $data, 'regNo');

            // Update the users table with full name and name with initials
            $userModel->updateUserNameDetails($regNo, [
                'fullName' => $data['fullName'],
                'nameWithInitial' => $data['nameWithInitial']
            ]);

            header("Location: " . URLROOT . "/admin/viewParent");
            exit();
        } else {
            // Fetch from parent model joined with user info
            $parents = $parentModel->first([
                'regNo' => $regNo
            ]);

            if ($parents) {
                // Fetch user info
                $userModel = new manage_useraccountModel();
                $user = $userModel->first(['regNo' => $regNo]);

                // Add user fields to parent object
                $parents->fullName = $user->fullName ?? '';
                $parents->nameWithInitial = $user->nameWithInitial ?? '';

                $this->view('inc/admin/edit_parent_by_admin', ['parents' => $parents]);
            } else {
                die('Parent not found.');
            }
        }
    }


    //Delete Parent recode
    public function deleteParent($regNo)
    {
        $parentModel = new manage_parentModel();

        // Delete the teacher
        $parentModel->delete($regNo, 'regNo');

        // Redirect to the view teachers page
        header("Location: " . URLROOT . "/admin/viewParent");
        exit();
    }



        
    // Manage Teacher details
        public function Manage_teacher(){

            $userModel = new manage_useraccountModel();
            $users = $userModel->findAll();

            $this->view('inc/admin/manage_teacher',['users' => $users]);
            
        }
    //for submit teacher details form
    public function submitTeacher()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $teacher = new manage_teacherModel();

            // Use model method to get the next teacher_id
            $newTeacherID = $teacher->getNextTeacherId();

            $teacherData = [
                'teacher_id' => $newTeacherID,
                'regNo' => trim($_POST['regNo']),
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'subject' => trim($_POST['subject']),
                'experience' => trim($_POST['experience']),
                'hireDate' => trim($_POST['hireDate'])
            ];

            $teacher->insert($teacherData);

            header("Location: " . URLROOT . "/Admin/viewTeacher");
            exit();
        } else {
            $this->view('Manage_teacher');
        }
    }



        public function viewTeacher()
        {
            $teacherModel = new manage_teacherModel();
            $teachers = $teacherModel->findAllWithUserInfo();

            // $nonacaModel = new manage_nonacaModel();
            // $nonacas = $nonacaModel->findAllWithUserInfo();

            $this->view('inc/Admin/Show_teacher', ['teachers' => $teachers]);
        }
//edit teacher function.
        public function editTeacher($teacher_id)
        {
            $teacherModel = new manage_teacherModel();
            $userModel = new manage_useraccountModel();
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'subject' => trim($_POST['subject']),
                    'experience' => trim($_POST['experience']),
                    'hireDate' => trim($_POST['hireDate'])
                ];
        
                // Update teacher table
                $teacherModel->update($teacher_id, $data, 'teacher_id');
        
                // Update user name details
                $regNo = trim($_POST['regNo']);
                $userData = [
                    'fullName' => trim($_POST['fullName']),
                    'nameWithInitial' => trim($_POST['nameWithInitial'])
                ];
                $userModel->updateUserNameDetails($regNo, $userData);
        
                header("Location: " . URLROOT . "/admin/viewTeacher");
                exit();
            } else {
                $teacher = $teacherModel->first(['teacher_id' => $teacher_id]);
        
                if ($teacher) {
                    // Fetch user's full name and initials
                    $userModel = new manage_useraccountModel();
                    $user = $userModel->first(['regNo' => $teacher->regNo]);
        
                    // Merge teacher and user info
                    $teacher->fullName = $user->fullName ?? '';
                    $teacher->nameWithInitial = $user->nameWithInitial ?? '';
        
                    $this->view('inc/admin/edit_teacher_by_admin', ['teacher' => $teacher]);
                } else {
                    die('Teacher not found.');
                }
            }
        }
        

        public function deleteTeacher($teacher_id)
        {
            $teacherModel = new manage_teacherModel();

            // Delete the teacher
            $teacherModel->delete($teacher_id, 'teacher_id');

            // Redirect to the view teachers page
            header("Location: " . URLROOT . "/admin/viewTeacher");
            exit();
        }


        /* For Principal */
        // Manage principal
        public function manage_principal(){

            $userModel = new manage_useraccountModel();
            $users = $userModel->findAll();

            $this->view('inc/admin/manage_principal',['users' => $users]);


        
            // $this->view('inc/Admin/Show_useraccount', ['users' => $users]);
        }
    

    //Submit Principal
        public function submitPrincipal()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $principalData = [
                
                    'principalId' => trim($_POST['principalId']),
                    'regNo' => trim($_POST['regNo']),
                    'firstName' => trim($_POST['firstName']),
                    'lastName' => trim($_POST['lastName']),
                    'experience' => trim($_POST['experience']),
                    'hireDate' => trim($_POST['hireDate'])



                ];

                $principal = new manage_principalModel();
                $principal->insert($principalData);
                // Here, save the teacher data to the database.
                // Example: $this->activityModel->addActivity($teacherData);

                // Display a success message or redirect to a success page
                header("Location: " . URLROOT . "/Admin/viewPrincipal");
                exit();
            } else {
                // If not a POST request, reload the manage teacher page
                $this->view('manage_principal');
            }
        }

        //View Principal details
        public function viewPrincipal()
        {
            $principalModel = new manage_principalModel();
            $principals = $principalModel->findAllWithUserInfo();

            $this->view('inc/Admin/Show_principal', ['principals' => $principals]);
        }


        // edit Principal details
        public function editPrincipal($principalId)
    {
        $principalModel = new manage_principalModel();
        $userModel = new manage_useraccountModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // First, fetch the principal's current regNo
            $principal = $principalModel->first(['principalId' => $principalId]);
            $regNo = $principal->regNo;

            // Prepare data for principal table
            $principalData = [
                'experience' => trim($_POST['experience']),
                'hireDate' => trim($_POST['hireDate'])
            ];

            // Prepare user name data
            $userData = [
                'fullName' => trim($_POST['fullName']),
                'nameWithInitial' => trim($_POST['nameWithInitial'])
            ];

            // Update both tables
            $principalModel->update($principalId, $principalData, 'principalId');
            $userModel->updateUserNameDetails($regNo, $userData);

            header("Location: " . URLROOT . "/admin/viewPrincipal");
            exit();
        } else {
            // Fetch principal and join with user info
            $principal = $principalModel->query("SELECT p.*, u.fullName, u.nameWithInitial 
                                                FROM principals p 
                                                JOIN users u ON p.regNo = u.regNo 
                                                WHERE p.principalId = :principalId", 
                                                ['principalId' => $principalId]);
            if ($principal && count($principal) > 0) {
                $this->view('inc/admin/edit_principal_by_admin', ['principal' => $principal[0]]);
            } else {
                die('Principal not found.');
            }
        }
    }

    //Delete Principal
        public function deletePrincipal($principalId)
        {
            $principalModel = new manage_principalModel();

            // Delete the teacher
            $principalModel->delete($principalId, 'principalId');

            // Redirect to the view teachers page
            header("Location: " . URLROOT . "/admin/viewPrincipal");
            exit();
        }

    /*For Vice Principle */
    //Manage Vice Principal
    public function manage_vice_principal(){

        $userModel = new manage_useraccountModel();
        $users = $userModel->findAll();

        $this->view('inc/admin/manage_vice_principal',['users' => $users]);
    }

    // Submit Vice Principal
    public function submitVicePrincipal()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vicePrincipalData = [
                'regNo' => trim($_POST['regNo']),
                'experience' => trim($_POST['experience']),
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'hireDate' => trim($_POST['hireDate'])
            ];

            $vicePrincipal = new manage_viceprincipalModel();
            $vicePrincipal->insert($vicePrincipalData);

            // Redirect after success
            header("Location: " . URLROOT . "/Admin/viewVicePrincipal");
            exit();
        } else {
            // If not a POST request, reload the form
            $this->view('manage_vice_principal');
        }
    }

    // View Vice Principal details
    public function viewVicePrincipal()
    {
        $vpModel = new manage_viceprincipalModel();
        $vicePrincipals = $vpModel->findAllWithUserInfo();

        $this->view('inc/Admin/show_vice_principal', ['vicePrincipals' => $vicePrincipals]);
    }

    public function editVicePrincipal($vicePrincipalId)
    {
        $vpModel = new manage_viceprincipalModel();
        $userModel = new manage_useraccountModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $regNo = trim($_POST['regNo']); // get regNo to update users table

            $vpData = [
                'experience' => trim($_POST['experience']),
                'hireDate' => trim($_POST['hireDate'])
            ];

            $userData = [
                'fullName' => trim($_POST['fullName']),
                'nameWithInitial' => trim($_POST['nameWithInitial'])
            ];

            $vpModel->update($vicePrincipalId, $vpData, 'vicePrincipalId');
            $userModel->updateUserNameDetails($regNo, $userData);

            header("Location: " . URLROOT . "/admin/viewVicePrincipal");
            exit();
        } else {
            $vicePrincipal = $vpModel->first(['vicePrincipalId' => $vicePrincipalId]);

            if ($vicePrincipal) {
                $user = (new manage_useraccountModel())->first(['regNo' => $vicePrincipal->regNo]);

                $this->view('inc/admin/edit_vice_principal_by_admin', [
                    'vicePrincipal' => $vicePrincipal,
                    'user' => $user
                ]);
            } else {
                die('Vice Principal not found.');
            }
        }
    }


    // Delete Vice Principal
    public function deleteVicePrincipal($vicePrincipalId)
    {
        $vpModel = new manage_viceprincipalModel();
        $vpModel->delete($vicePrincipalId, 'vicePrincipalId');

        header("Location: " . URLROOT . "/admin/viewVicePrincipal");
        exit();
    }
    
        /* For Non-academic */
        // Manage non-academic staff
        public function manage_nonaca(){

            $userModel = new manage_useraccountModel();
            $users = $userModel->findAll();
        
            $this->view('inc/admin/manage_nonaca',['users' => $users]);
        }

        //for submit NonAcademic details form
        public function submitNonaca()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nonacaData = [
                    'regNo' => trim($_POST['regNo']),
                    'position' => trim($_POST['position']),
                    'department' => trim($_POST['department']),
                    'hireDate' => trim($_POST['hireDate'])

                ];

                $nonaca = new manage_nonacaModel();
                $nonaca->insert($nonacaData);
                // Here, save the teacher data to the database.
                // Example: $this->activityModel->addActivity($teacherData);

                // Display a success message or redirect to a success page
                header("Location: " . URLROOT . "/Admin/viewNonaca");
                exit();
            } else {
                // If not a POST request, reload the manage teacher page
                $this->view('manage_nonaca');
            }
        }
    //View nonacademic details
        public function viewNonaca()
        {
            $nonacaModel = new manage_nonacaModel();
            // $nonacas = $nonacaModel->findAll();
            $nonacas = $nonacaModel->findAllWithUserInfo();

            $this->view('inc/Admin/Show_nonaca', ['nonacas' => $nonacas]);
        }

        public function editNonaca($staffId)
        {
            $nonacaModel = new manage_nonacaModel();
            $userModel = new manage_useraccountModel();
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'regNo' => trim($_POST['regNo']),
                    'position' => trim($_POST['position']),
                    'department' => trim($_POST['department']),
                    'hireDate' => trim($_POST['hireDate']),
                ];
        
                $userData = [
                    'fullName' => trim($_POST['fullName']),
                    'nameWithInitial' => trim($_POST['nameWithInitial']),
                ];
        
                // Update non-academic staff table
                $nonacaModel->update($staffId, $data, 'staffId');
        
                // Update user table
                $userModel->updateUserNameDetails($data['regNo'], $userData);
        
                header("Location: " . URLROOT . "/admin/viewNonaca");
                exit();
            } else {
                // Manual filter to find the specific staff member
                $nonacas = $nonacaModel->findAllWithUserInfo();
                $nonaca = null;
        
                foreach ($nonacas as $n) {
                    if ($n->staffId == $staffId) {
                        $nonaca = $n;
                        break;
                    }
                }
        
                if ($nonaca) {
                    $this->view('inc/admin/edit_nonaca_by_admin', ['nonaca' => $nonaca]);
                } else {
                    die('Staff member not found.');
                }
            }
        }
        
        
        

        //Delete Nonacademic
        public function deleteNonaca($staffId)
        {
            $nonacaModel = new manage_nonacaModel();

            // Delete the teacher
            $nonacaModel->delete($staffId, 'staffId');

            // Redirect to the view teachers page
            header("Location: " . URLROOT . "/admin/viewNonaca");
            exit();
        }

        /* For Classroom */
        // Manage classroom
        public function manage_class(){

            $teacherModel = new manage_teacherModel();
            $teachers = $teacherModel->findAll();

            $this->view('inc/admin/manage_class', ['teachers' => $teachers]);
        }

        /* Insert classroom details */
            //for submitclass details form
            public function submitClass()
            {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $classData = [
                        'classId' => trim($_POST['classId']),
                        'className' => trim($_POST['className']),
                        'academicYear' => trim($_POST['academicYear']) // Match DB column name
                    ];
            
                    $classModel = new manage_classModel();
                    $classModel->insert($classData);
            
                    // Redirect to view all classes
                    header("Location: " . URLROOT . "/admin/viewClass");
                    exit();
                } else {
                    // Show the form again if not POST
                    $this->view('admin/manage_class');
                }
            }
            
            public function viewClass()
            {
                $classModel = new manage_classModel();
                $classes = $classModel->findAll();
            
                $this->view('inc/Admin/Show_class', ['classes' => $classes]);
            }
            
            public function editClass($classId)
            {
                $classModel = new manage_classModel();
            
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data = [
                        'classId' => trim($_POST['classId']),
                        'className' => trim($_POST['className']),
                        'academicYear' => trim($_POST['academicYear'])
                    ];
            
                    $classModel->update($classId, $data, 'classId');
            
                    header("Location: " . URLROOT . "/admin/viewClass");
                    exit();
                } else {
                    $classData = $classModel->first(['classId' => $classId]);
            
                    if ($classData) {
                        $this->view('inc/admin/edit_class_by_admin', ['class' => $classData]);
                    } else {
                        die('Class not found.');
                    }
                }
            }
            
            public function deleteClass($classId)
            {
                $classModel = new manage_classModel();
                $classModel->delete($classId, 'classId');
            
                header("Location: " . URLROOT . "/admin/viewClass");
                exit();
            }




            /*Back up users */

            public function viewBackupUsers() {
                $backupModel = new backupusersModel();
            
                // Fetch all backup users
                $backupUsers = $backupModel->findAll();
            
                // Load the view and pass data
                $this->view('inc/admin/show_backupusers', ['backupusers' => $backupUsers]);
            }
         
}


