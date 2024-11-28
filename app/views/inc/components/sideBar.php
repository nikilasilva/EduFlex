<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

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
    if (isset($_SESSION['user']['role'])) {
        $role = $_SESSION['user']['role'];

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
            case 'parent':
                    include APPROOT.'/views/inc/Parent/sidebar_parent.php';
                    break;
            
            default:
                // Load a general sidebar
                echo '
                <div class="menu-bar">
                    <div class="menu">
                        <ul class="menu-links">
                            <li class="nav-links"><a href="<?php echo URLROOT ?>/Dashboard/index"><i class="fa-solid fa-house icon"></i><span class="text nav-text">Home</span></a></li>
                        </ul>
                    </div>
                </div>
                ';                
                break;
        }
    }
     else {
        echo '
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-links"><a href="<?php echo URLROOT ?>/Dashboard/index"><i class="fa-solid fa-house icon"></i><span class="text nav-text">Home</span></a></li>
                </ul>
            </div>
        </div>
        ';  
    }
    ?>
</nav>
