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

<section class="page-hero">
    <div class="container text-center">
        <h1>Our Comprehensive Services</h1>
        <p>From essential device repairs to innovative digital solutions, TechSolutions Hub covers all your technology needs with expertise and dedication.</p>
    </div>
</section>

<section class="services-list-overview">
    <div class="container">
        <h2 class="section-title">Discover Our Expertise Areas</h2>
        <div class="card-grid">
            <?php foreach ($services_data as $slug => $service): ?>
                <div class="card">
                    <div class="icon">
                        <?php
                            // Dynamic icon based on slug
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
                    <a href="services_<?php echo htmlspecialchars($slug); ?>.php" class="button primary-button">Explore Service</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action for Services Page -->
<section class="call-to-action">
    <div class="container text-center">
        <h2>Can't find what you're looking for?</h2>
        <p>Our team is ready to discuss your specific tech requirements and provide tailored solutions.</p>
        <a href="contact.php" class="button secondary-button">Contact Us Directly</a>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>