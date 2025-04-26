<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="user-profile-container container">
    <div class="user-profile-header">
        <h1>Profile</h1>
    </div>
    <div class="user-profile-card">
        <div class="user-profile-image-section">
            <?php
                $profilePath = $_SESSION['user']['profile_picture'] ?? $data['user']->profile_picture ?? '';
                $testPath = APPROOT . '/../' . $profilePath;              
                
                if (!empty($profilePath) && file_exists($testPath)) {
                    $imgSrc = URLROOT . '/' . ltrim($profilePath, '/');
                } else {
                    $imgSrc = URLROOT . '/public/img/profiles/default-profile.jpg';
                }
            ?>
            <img src="<?php echo $imgSrc ?>" alt="User Photo" class="user-profile-photo">
        </div>
        <div class="user-profile-info-section">
            <h2 class="user-name"> <?php echo htmlspecialchars(ucwords($data['user']->nameWithInitial)); ?> </h2>
            <ul class="user-details">
                <li><strong>Full Name:</strong> <?php echo htmlspecialchars($data['user']->fullName); ?> </li>
                <li><strong>Gender:</strong> <?php echo htmlspecialchars($data['user']->gender); ?> </li>
                <li><strong>Date of Birth:</strong> <?php echo htmlspecialchars($data['user']->dob); ?> </li> 
                <li><strong>Email:</strong> <?php echo htmlspecialchars($data['user']->email); ?> </li>
                <li><strong>Phone:</strong> <?php echo htmlspecialchars($data['user']->mobileNo); ?> </li>
                <li><strong>Address:</strong> <?php echo htmlspecialchars($data['user']->address); ?> </li>
                <li><strong>Religion:</strong> <?php echo htmlspecialchars($data['user']->religion); ?> </li>
            </ul>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>