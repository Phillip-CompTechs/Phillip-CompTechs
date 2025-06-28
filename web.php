<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Define the unique slug for THIS service page
$service_slug = 'computer-repair'; // <<< REMEMBER TO CHANGE THIS FOR EACH FILE!
// For services_phone_repair.php, it will be 'phone-repair'
// For services_web_dev.php, it will be 'web-development'
// For services_design.php, it will be 'design-making'


require_once 'functions.php'; // Ensure functions and $services_data are available

// Get the specific service data based on the slug
$current_service = $services_data[$service_slug] ?? null;

// If the service data isn't found (e.g., direct access with invalid slug), redirect to general services page
if (!$current_service) {
    header('Location: services.php');
    exit;
}

include 'header.php';
?>

<section class="page-hero">
    <div class="container text-center">
        <h1><?php echo htmlspecialchars($current_service['title']); ?></h1>
        <p><?php echo htmlspecialchars($current_service['subtitle']); ?></p>
    </div>
</section>

<section class="service-detail-section">
    <div class="container">
        <div class="service-detail-content">
            <div class="service-detail-image">
                <img src="<?php echo htmlspecialchars($current_service['image']); ?>" alt="Image for <?php echo htmlspecialchars($current_service['title']); ?>">
            </div>
            <div class="service-detail-text">
                <h2>Comprehensive <?php echo htmlspecialchars($current_service['title']); ?> Solutions</h2>
                <p><?php echo nl2br(htmlspecialchars($current_service['description'])); ?></p>
                <h3>Key Features of Our Service:</h3>
                <ul>
                    <?php foreach ($current_service['features'] as $feature): ?>
                        <li><i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="booking.php?service=<?php echo htmlspecialchars($service_slug); ?>" class="button primary-button">Book This Service</a>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action for Service Detail Page -->
<section class="call-to-action">
    <div class="container text-center">
        <h2>Ready to get your <?php echo htmlspecialchars(strtolower($current_service['title'])); ?> sorted or launch your next project?</h2>
        <p>Contact us today for a free consultation or easily book your service online!</p>
        <div style="margin-top: 30px;">
            <a href="contact.php" class="button secondary-button" style="margin-right: 15px;">Get a Free Quote</a>
            <a href="booking.php?service=<?php echo htmlspecialchars($service_slug); ?>" class="button primary-button">Book Now</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>