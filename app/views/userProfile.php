<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/components/topNavbar.php'; ?>
<?php require APPROOT . '/views/inc/components/sideBar.php'; ?>

<div class="user-profile-container">
    <div class="user-profile-header">
        <h1>Profile</h1>
    </div>
    <div class="user-profile-card">
        <div class="user-profile-image-section">
            <img src="<?php echo URLROOT; ?>/public/img/profileImg.png" alt="User Photo" class="user-profile-photo">
        </div>
        <div class="user-profile-info-section">
            <h2 class="user-name"> <?php echo htmlspecialchars(ucwords($data['user']->username)); ?> </h2>
            <ul class="user-details">
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