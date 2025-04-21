<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/components/topNavbar.php'; ?>
<script>document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.slide'); // Select all slides
    let currentSlide = 0; // Track the current slide

    // Function to display a specific slide
    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active'); // Hide all slides
            if (i === index) {
                slide.classList.add('active'); // Show the selected slide
            }
        });
    }

    // Function to move to the next slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length; // Loop back to first slide
        showSlide(currentSlide);
    }

    // Show the first slide initially
    showSlide(currentSlide);

    // Automatically change slides every 5 seconds
    setInterval(nextSlide, 3500);
});
</script>

<div class="background-container">
    <!-- Slideshow Images -->
    <div class="slideshow">
        <img class="slide" src="<?php echo URLROOT; ?>/public/img/home1.jpg" alt="Slide 1">
        <img class="slide" src="<?php echo URLROOT; ?>/public/img/home2.jpg" alt="Slide 2">
        <img class="slide" src="<?php echo URLROOT; ?>/public/img/home3.jpg" alt="Slide 3">
    </div>
    <!-- Overlay for Text -->
    <div class="overlay">
    <h2 class="welcome-text2">Welcome To</h2>
        <h1 class="welcome-text">RAJASINGHE     COLLEGE</h1>
        <h2 class="welcome-text2">School Management System</h2>
    </div>
</div>

<main class="main-content">
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

<section class="school-contact">
        <h2>Contact Us</h2>
        <p>Email: rajasinghecollege@gmail.com | Phone: 011 123 4567</p>
    </section>
<?php require APPROOT.'/views/inc/footer.php'; ?>

