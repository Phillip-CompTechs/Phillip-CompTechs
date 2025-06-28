<?php
// Get the current page filename (e.g., 'index.php', 'about.php')
$current_page = basename($_SERVER['PHP_SELF']);
require_once __DIR__ . '/functions.php'; // Include functions and $services_data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TechSphere Solutions Hub offers expert computer & phone repair, web development, and graphic design services in Masvingo, Zimbabwe.">
    <meta name="keywords" content="computer repair, phone repair, web development, graphic design, Masvingo, Zimbabwe, TechSphere solutions, IT services">
    <meta name="author" content="TechSolutions Hub Team">
    <title>TechSolutions Hub - <?php echo ucwords(str_replace(['_', '.php'], [' ', ''], $current_page)); ?></title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Global CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Hero Section Specific CSS (only for home page, but included globally for simplicity) -->
    <link rel="stylesheet" href="hero.css">
    <!-- Font Awesome for icons -->
   <link rel="stylesheet" href="style.css">
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="index.php">TECH-SPHERE SOLUTIONS HUB</a>
            </div>
            <nav class="main-nav">
                <ul class="nav-links">
                    <li><a href="index.php" class="<?php echo is_active_page($current_page, 'index.php'); ?>">Home</a></li>
                    <li class="dropdown">
                        <a href="services.php" class="<?php echo is_service_parent_active($current_page); ?>">Services <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="services_computer_repair.php">Computer Repair</a>
                            <a href="services_phone_repair.php">Phone Repair</a>
                            <a href="services_web_dev.php">Web Development</a>
                            <a href="services_design.php">Design Making</a>
                        </div>
                    </li>
                    <li><a href="about.php" class="<?php echo is_active_page($current_page, 'about.php'); ?>">About</a></li>
                    <li><a href="contact.php" class="<?php echo is_active_page($current_page, 'contact.php'); ?>">Contact</a></li>
                    <li><a href="booking.php" class="button primary-button <?php echo is_active_page($current_page, 'booking.php'); ?>">Bookings</a></li>
                </ul>
                <div class="hamburger" aria-label="Toggle navigation menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>
    <main>
