<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

    <main class="main-content">
        <img class="school-img" src="<?php echo URLROOT; ?>/public/img/schoolBG.png" alt="School Building">
        <div class="motto-vision-container">
            <section class="motto">
                <img src="<?php echo URLROOT; ?>/public/img/mission.png" alt="motto">
                <h2>Motto</h2>
                <p>"Empowering Minds, Shaping Futures."</p>
            </section>
            <section class="vision">
                <img src="<?php echo URLROOT; ?>/public/img/vision.png" alt="vision">
                <h2>Vision</h2>
                <p>"To empower every student to become a lifelong learner, critical thinker, and compassionate global citizen, 
                    equipped with the knowledge, skills, and values necessary to thrive in an ever-changing world."</p>
            </section>
        </div>
    </main>
    <?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>