<?php require APPROOT.'/views/inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduFlex - School Management System</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/landing.css">
</head>
<body>
<div class="landing-container">

    <!-- Hero Section -->
    <section class="hero">
    <!-- Blurred Background -->
    <div class="hero-bg"></div>

    <!-- Hero Content -->
    <div class="hero-text">
        <img src="<?php echo URLROOT; ?>/public/img/logo_noBG.png" alt="EduFlex Logo" class="logo">
        <h1>Welcome to <span>EduFlex</span></h1>
        <p>Transforming education with modern technology</p>
        <a href="<?php echo URLROOT; ?>/login" class="btn-primary">Get Started</a>
    </div>
</section>

    <!-- Features Section -->
    <section class="features">
        <h2>Why Choose EduFlex?</h2>
        <div class="feature-cards">
            <div class="card">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG.png" alt="Student Management">
                <h3>Student Management</h3>
                <p>Keep track of student performance and attendance seamlessly.</p>
            </div>
            <div class="card">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG.png" alt="Teacher Management">
                <h3>Teacher Management</h3>
                <p>Efficiently manage teacher schedules and records.</p>
            </div>
            <div class="card">
                <img src="<?php echo URLROOT; ?>/public/img/logo_noBG.png" alt="Reports">
                <h3>Detailed Reports</h3>
                <p>Generate insightful reports for informed decision-making.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2>What People Say</h2>
        <div class="testimonials-container">
            <div class="testimonial">
                <p>"EduFlex has revolutionized the way we manage our school. It's efficient and easy to use!"</p>
                <h4>- Principal, ABC School</h4>
            </div>
            <div class="testimonial">
                <p>"The attendance and report generation features save me so much time."</p>
                <h4>- Teacher, XYZ School</h4>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <h2>Contact Us</h2>
        <p>Email: support@eduflex.com | Phone: +1 800 123 4567</p>
    </section>

</div>
</body>
</html>
<?php require APPROOT.'/views/inc/footer.php'; ?>

