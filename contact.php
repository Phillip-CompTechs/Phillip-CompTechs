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
require_once 'functions.php'; // Include functions for sanitization and form handling

$name = $email = $subject = $message_content = "";
$name_err = $email_err = $subject_err = $message_err = "";
$submission_status = ""; // Can be "success", "error", or empty

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = sanitize_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z\s.-]+$/", $name)) { // Allow letters, spaces, dots, dashes
            $name_err = "Name can only contain letters, spaces, dots, or dashes.";
        }
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = sanitize_input($_POST["email"]);
    }

    // Validate Subject
    if (empty(trim($_POST["subject"]))) {
        $subject_err = "Please enter a subject.";
    } else {
        $subject = sanitize_input($_POST["subject"]);
    }

    // Validate Message
    if (empty(trim($_POST["message_content"]))) {
        $message_err = "Message cannot be empty.";
    } else {
        $message_content = sanitize_input($_POST["message_content"]);
        if (strlen($message_content) < 10) {
            $message_err = "Message must be at least 10 characters long.";
        }
    }

    // If no errors, process submission
    if (empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)) {
        $contact_data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message_content
        ];

        if (handle_form_submission('contact_messages', $contact_data)) {
            $submission_status = "success";
            // Clear form fields after successful submission
            $name = $email = $subject = $message_content = "";
        } else {
            $submission_status = "error";
            $message_err = "There was an error submitting your message. Please try again.";
        }
    }
}

include 'header.php';
?>
<script src="contact.js"></script> <!-- Page-specific JS for form validation and map -->

<section class="page-hero">
    <div class="container text-center">
        <h1>Contact TechSolutions Hub</h1>
        <p>We'd love to hear from you! Reach out for inquiries, technical support, or to discuss your next project.</p>
    </div>
</section>

<section class="contact-form-section">
    <div class="container">
        <h2 class="section-title">Get in Touch With Us</h2>
        <div class="contact-grid">
            <div class="contact-form-wrapper">
                <?php if ($submission_status === "success"): ?>
                    <p class="success-message" role="alert">Thank you for your message! We will get back to you shortly.</p>
                <?php elseif ($submission_status === "error"): ?>
                    <p class="error-message" role="alert"><?php echo htmlspecialchars($message_err); ?></p>
                <?php endif; ?>

                <form id="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                    <div class="form-group">
                        <label for="name">Your Full Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required aria-required="true">
                        <span class="error-message" id="nameError"><?php echo htmlspecialchars($name_err); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email Address:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required aria-required="true">
                        <span class="error-message" id="emailError"><?php echo htmlspecialchars($email_err); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject:</label>
                        <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>" required aria-required="true">
                        <span class="error-message" id="subjectError"><?php echo htmlspecialchars($subject_err); ?></span>
                    </div>
                    <div class="form-group">
                        <label for="message_content">Your Message:</label>
                        <textarea id="message_content" name="message_content" rows="7" required aria-required="true"><?php echo htmlspecialchars($message_content); ?></textarea>
                        <span class="error-message" id="messageError"><?php echo htmlspecialchars($message_err); ?></span>
                    </div>
                    <button type="submit" class="button primary-button">Send Message</button>
                </form>
            </div>
            <div class="contact-info">
                <h3>Our Contact Details</h3>
                <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> Bondolfi Trs Cllg,Masvingo Zimbabwe</p>
                <p><i class="fas fa-phone"></i> <strong>Phone:</strong> <a href="tel:+263771234567">+263 773 114 007</a></p>
                <p><i class="fas fa-envelope"></i> <strong>Email:</strong> <a href="mailto:info@TechSphereSolutionsHub.co.zw">info@TechSphereSolutionsHub.co.zw</a></p>
                <p><i class="fas fa-clock"></i> <strong>Business Hours:</strong><br>Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday & Sunday: 8:00 AM
            - 13:00 </p>
                <div class="social-links">
                    <a href="https://www.facebook.com/.co.zw" target="_blank" rel="noopener noreferrer" aria-label="Find us on Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/techsolutionshubTechSphereSolutionsHub" target="_blank" rel="noopener noreferrer" aria-label="Find us on Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/TechSphereSolutionsHub" target="_blank" rel="noopener noreferrer" aria-label="Find us on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://www.instagram.com/tTechSphereSolutionsHub" target="_blank" rel="noopener noreferrer" aria-label="Find us on Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div id="map" aria-label="Our business location on Google Map"></div> <!-- Google Map will load here -->
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>