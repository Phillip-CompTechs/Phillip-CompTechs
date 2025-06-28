<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php include 'header.php'; ?>
<script src="home.js"></script> <!-- Page-specific JS for testimonials slider -->

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Your Trusted Partner for All Things Tech</h1>
        <p>Expert repairs, innovative web solutions, and stunning designs to elevate your digital presence.</p>
        <div class="hero-buttons">
            <a href="booking.php" class="button primary-button">Book a Service Today</a>
            <a href="services.php" class="button secondary-button">Explore All Services</a>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section class="introduction-section">
    <div class="container text-center">
        <h2 class="section-title">Welcome to TechSolutions Hub</h2>
        <p class="lead-text">At TechSolutions Hub, we are dedicated to providing top-notch technical services to individuals and businesses across Harare and beyond. Whether you're facing a broken device, need a captivating website, or require professional design work, our skilled and certified team is here to help you achieve your goals with efficiency and excellence.</p>
        <p>With years of hands-on experience and a deep passion for technology, we pride ourselves on delivering reliable solutions, transparent communication, and outstanding customer satisfaction. Discover how our expertise can empower your digital journey and solve your tech challenges.</p>
    </div>
</section>

<!-- Services Overview Section -->
<section class="services-overview-section">
    <div class="container">
        <h2 class="section-title">Our Core Services</h2>
        <div class="card-grid">
            <?php foreach ($services_data as $slug => $service): ?>
            <div class="card">
                <div class="icon">
                    <?php
                        $icon_class = 'fas fa-cogs'; // Default
                        if ($slug === 'computer-repair') $icon_class = 'fas fa-desktop';
                        else if ($slug === 'phone-repair') $icon_class = 'fas fa-mobile-alt';
                        else if ($slug === 'web-development') $icon_class = 'fas fa-code';
                        else if ($slug === 'design-making') $icon_class = 'fas fa-paint-brush';
                    ?>
                    <i class="<?php echo $icon_class; ?>"></i>
                </div>
                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                <p><?php echo htmlspecialchars($service['subtitle']); ?></p>
                <a href="services_<?php echo htmlspecialchars($slug); ?>.php" class="button primary-button">Learn More</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us-section">
    <div class="container text-center">
        <h2 class="section-title">Why TechSolutions Hub is Your Best Choice</h2>
        <div class="card-grid">
            <div class="card">
                <div class="icon"><i class="fas fa-cogs"></i></div>
                <h3>Experienced Professionals</h3>
                <p>Our team comprises highly skilled and certified technicians and developers with years of industry experience, ensuring expert solutions.</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-award"></i></div>
                <h3>Quality Guaranteed</h3>
                <p>We use only the highest quality parts and adhere to industry best practices to ensure durable, lasting solutions for all your tech needs.</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-handshake"></i></div>
                <h3>Customer Satisfaction</h3>
                <p>Your satisfaction is our ultimate priority. We offer transparent communication, personalized service, and a commitment to exceed expectations.</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                <h3>Fast & Efficient Service</h3>
                <p>We understand your time is valuable. Our streamlined processes and dedicated team ensure quick turnaround times without compromising quality.</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Secure & Reliable</h3>
                <p>We prioritize the security of your data and devices, implementing robust protocols to ensure your information is safe with us.</p>
            </div>
            <div class="card">
                <div class="icon"><i class="fas fa-headset"></i></div>
                <h3>Dedicated Support</h3>
                <p>Our friendly support team is always ready to assist you with any questions or concerns, providing clear and helpful guidance.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title">What Our Valued Clients Say</h2>
        <div class="testimonial-slider">
            <div class="testimonial-container">
                <div class="testimonial-item">
                    <p>"My laptop was completely dead, and TechSolutions Hub brought it back to life! Fast, professional, and excellent service. I highly recommend them for any computer repair needs."</p>
                    <div class="author">- Jane D., Small Business Owner</div>
                </div>
                <div class="testimonial-item">
                    <p>"They built our new e-commerce website from scratch, and it's fantastic! Very responsive, easy to work with, and the end result exceeded our expectations. Truly great web development!"</p>
                    <div class="author">- Mark S., Online Retailer</div>
                </div>
                <div class="testimonial-item">
                    <p>"Cracked my phone screen badly. TechSolutions fixed it in less than an hour, and it looks brand new. Affordable and super quick. Best phone repair service in town!"</p>
                    <div class="author">- Emily R., Student</div>
                </div>
                <div class="testimonial-item">
                    <p>"The team created a stunning logo and brand identity for my startup. Their design skills are top-notch, and they really captured my vision. Highly creative and professional to work with."</p>
                    <div class="author">- David L., Startup Founder</div>
                </div>
                <div class="testimonial-item">
                    <p>"Exceptional service for my gaming PC. They diagnosed a tricky issue quickly and offered a very fair price for the repair. My go-to tech guys now!"</p>
                    <div class="author">- Alex T., Gamer</div>
                </div>
                <div class="testimonial-item">
                    <p>"We needed a new website fast for an urgent campaign, and TechSolutions Hub delivered flawlessly. Their attention to detail and speed were incredible."</p>
                    <div class="author">- Sarah P., Marketing Manager</div>
                </div>
            </div>
            <div class="slider-dots" role="tablist" aria-label="Testimonial slider navigation"></div>
        </div>
    </div>
</section>

</div>

<section id="privacy" class="legal-section">
  <h2>Privacy Policy</h2>
  <p>
    TechSphere is committed to protecting your personal data. We collect minimal, relevant information for the purpose of delivering high-quality services in computer and phone repair, as well as web design and development.
  </p>
  <ul>
    <li><strong>Information Use:</strong> Data is used solely to diagnose issues, process orders, or build websites to your specifications.</li>
    <li><strong>Data Security:</strong> We use secure tools and encryption where needed to protect customer data.</li>
    <li><strong>No Sharing:</strong> We never sell or share your information with third parties without your explicit permission.</li>
    <li><strong>Cookies:</strong> Our website may use cookies to improve performance. You can disable them in your browser settings.</li>
  </ul>
</section>

<section id="terms" class="legal-section">
  <h2>Terms of Service</h2>
  <p>
    By using TechSphere's services, you agree to the following terms:
  </p>
  <ul>
    <li><strong>Service Scope:</strong> We offer diagnostics, repairs, website development, and UI/UX design services with professional standards.</li>
    <li><strong>Device Access:</strong> You grant us permission to access and service your device or system during the repair or development process.</li>
    <li><strong>Liability:</strong> TechSphere is not responsible for data loss on devices. Clients are encouraged to back up data before service.</li>
    <li><strong>Payment:</strong> Full payment is required after successful service delivery unless otherwise agreed.</li>
    <li><strong>Revisions:</strong> For design and development, you are entitled to limited revisions as agreed in the service scope.</li>
  </ul>
</section>
</div>

<?php include 'footer.php'; ?>

</body>
</html>