<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG1.png" alt="Logo">
            </span>
            <div class="text header-text">
                <span class="name">EduFlex</span>
            </div>
            <i class="fa-solid fa-bars toggle"></i>
        </div>
    </header>
    <?php
    // Get the user role from session
    // if (isset($_SESSION['user_role'])) {
    //     $role = $_SESSION['user_role'];
        $role = 'principal';

        // Dynamically load the sidebar for the specific role
        switch ($role) {
            case 'admin':
                include APPROOT.'/views/inc/admin/sidebar_admin.php';
                break;
            case 'teacher':
                include APPROOT.'/views/inc/teacher/sidebar_teacher.php';
                break;
            case 'student':
                include APPROOT.'/views/inc/student/sidebar_student.php';
                break;
            case 'principal':
                include APPROOT.'/views/inc/principal/sidebar_principal.php';
                break;
            case 'vice-principal':
                include APPROOT.'/views/inc/vicePrincipal/sidebar_vicePrincipal.php';
                break;
            case 'non-academic':
                include APPROOT.'/views/inc/nonAcademic/sidebar_nonAcademic.php';
                break;
            default:
                // Load a general sidebar or error message if role not recognized
                echo "<p>Role not recognized</p>";
                break;
        }
    // } else {
    //     // Redirect to login or show an error if no session exists
    //     header('Location: login.php');
    //     exit();
    // }
    ?>
    <!-- <button class="toggle-btn" onclick="toggleSidebar()">button</button> -->
</nav>
