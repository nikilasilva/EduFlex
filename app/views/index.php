<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>

<!-- Hero Section with Moving Pictures -->
<section class="hero">
    <div class="carousel">
        <div class="carousel-images">
            <img src="<?php echo URLROOT; ?>/public/img/schoolBG1.png" alt="School Campus">
            <img src="<?php echo URLROOT; ?>/public/img/schoolBG2.png" alt="Students in Class">
            <img src="<?php echo URLROOT; ?>/public/img/schoolBG3.png" alt="Library">
        </div>
    </div>
</section>

<main class="main-content">
    <!-- Motto and Vision Section -->
    <div class="motto-vision-container">
        <section class="motto">
            <img src="<?php echo URLROOT; ?>/public/img/mission.png" alt="Motto Icon">
            <h2>Motto</h2>
            <p>"Empowering Minds, Shaping Futures."</p>
        </section>
        <section class="vision">
            <img src="<?php echo URLROOT; ?>/public/img/vision.png" alt="Vision Icon">
            <h2>Vision</h2>
            <p>"To empower every student to become a lifelong learner, critical thinker, and compassionate global citizen, 
                equipped with the knowledge, skills, and values necessary to thrive in an ever-changing world."</p>
        </section>
    </div>
    
    <!-- Contact Section -->
    <div class="contact-container">
        <h2>Contact Us</h2>
        <p>If you have any questions or inquiries, feel free to reach out to us:</p>
        <p><strong>Phone:</strong> +1 234 567 890</p>
        <p><strong>Email:</strong> info@schoolmanagement.com</p>
        <p><strong>Address:</strong> 123 School Road, Education City</p>
    </div>
</main>

<?php require APPROOT.'/views/inc/components/sideBar.php'; ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>