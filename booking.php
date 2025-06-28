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

$full_name = $booking_email = $phone = $service_type = $preferred_date = $preferred_time = $issue_description = "";
$full_name_err = $booking_email_err = $phone_err = $service_type_err = $preferred_date_err = $preferred_time_err = $issue_description_err = "";
$submission_status = ""; // Can be "success", "error", or empty

// Pre-select service if coming from a service detail page via GET parameter
if (isset($_GET['service']) && array_key_exists($_GET['service'], $services_data)) {
    $service_type = sanitize_input($_GET['service']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Full Name
    if (empty(trim($_POST["full_name"]))) {
        $full_name_err = "Full Name is required.";
    } else {
        $full_name = sanitize_input($_POST["full_name"]);
        if (!preg_match("/^[a-zA-Z\s.-]+$/", $full_name)) {
            $full_name_err = "Name can only contain letters, spaces, dots, or dashes.";
        }
    }

    // Validate Email
    if (empty(trim($_POST["booking_email"]))) {
        $booking_email_err = "Email is required.";
    } elseif (!filter_var(trim($_POST["booking_email"]), FILTER_VALIDATE_EMAIL)) {
        $booking_email_err = "Please enter a valid email address.";
    } else {
        $booking_email = sanitize_input($_POST["booking_email"]);
    }

    // Validate Phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Phone number is required.";
    } else {
        $phone = sanitize_input($_POST["phone"]);
        // Basic phone number regex: allows +, -, (), spaces, and digits, min 3 digits
        if (!preg_match("/^\+?[0-9\s-()]{7,20}$/", $phone)) {
            $phone_err = "Please enter a valid phone number (min 3 digits).";
        }
    }

    // Validate Service Type
    if (empty($_POST["service_type"]) || !array_key_exists($_POST["service_type"], $services_data)) {
        $service_type_err = "Please select a valid service type.";
    } else {
        $service_type = sanitize_input($_POST["service_type"]);
    }

    // Validate Preferred Date
    if (empty(trim($_POST["preferred_date"]))) {
        $preferred_date_err = "Preferred date is required.";
    } else {
        $preferred_date = sanitize_input($_POST["preferred_date"]);
        // Basic future date check
        $today = new DateTime();
        $selected_date_obj = DateTime::createFromFormat('Y-m-d', $preferred_date);
        if (!$selected_date_obj || $selected_date_obj < $today->setTime(0,0,0)) {
            $preferred_date_err = "Please select a future date.";
        }
    }

    // Validate Preferred Time
    if (empty(trim($_POST["preferred_time"]))) {
        $preferred_time_err = "Preferred time is required.";
    } else {
        $preferred_time = sanitize_input($_POST["preferred_time"]);
        // Optional: Add more specific time validation (e.g., within business hours)
    }

    // Validate Issue Description
    if (empty(trim($_POST["issue_description"]))) {
        $issue_description_err = "Please describe your issue/project needs.";
    } else {
        $issue_description = sanitize_input($_POST["issue_description"]);
        if (strlen($issue_description) < 20) {
            $issue_description_err = "Description must be at least 20 characters long.";
        }
    }

    // If no errors, process submission
    if (empty($full_name_err) && empty($booking_email_err) && empty($phone_err) && empty($service_type_err) &&
        empty($preferred_date_err) && empty($preferred_time_err) && empty($issue_description_err)) {

        $booking_data = [
            'full_name' => $full_name,
            'email' => $booking_email,
            'phone' => $phone,
            'service_type' => $services_data[$service_type]['title'] ?? $service_type, // Store full title
            'preferred_date' => $preferred_date,
            'preferred_time' => $preferred_time,
            'issue_description' => $issue_description
        ];

        if (handle_form_submission('bookings', $booking_data)) {
            $submission_status = "success";
            // Clear form fields after successful submission
            $full_name = $booking_email = $phone = $service_type = $preferred_date = $preferred_time = $issue_description = "";
        } else {
            $submission_status = "error";
            $issue_description_err = "There was an error submitting your booking. Please try again.";
        }
    }
}

include 'header.php';
?>
<script src="booking.js"></script> <!-- Page-specific JS for form validation and dynamic description -->

<section class="page-hero">
    <div class="container text-center">
        <h1>Book a Service or Request a Quote</h1>
        <p>Easily schedule your tech repair or get a personalized quote for your web development or design project.</p>
    </div>
</section>

<section class="booking-form-section">
    <div class="container">
        <h2 class="section-title">Schedule Your Service Appointment</h2>
        <p class="text-center lead-text">Fill out the form below with your details and service needs. We'll review your request and get back to you promptly to confirm your appointment or provide a detailed quote.</p>

        <?php if ($submission_status === "success"): ?>
            <p class="success-message" role="alert">Your booking/quote request has been successfully submitted! We will contact you shortly to confirm details.</p>
        <?php elseif ($submission_status === "error"): ?>
            <p class="error-message" role="alert"><?php echo htmlspecialchars($issue_description_err); ?></p>
        <?php endif; ?>

        <form id="bookingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required aria-required="true">
                <span class="error-message" id="fullNameError"><?php echo htmlspecialchars($full_name_err); ?></span>
            </div>
            <div class="form-group">
                <label for="booking_email">Email Address:</label>
                <input type="email" id="booking_email" name="booking_email" value="<?php echo htmlspecialchars($booking_email); ?>" required aria-required="true">
                <span class="error-message" id="bookingEmailError"><?php echo htmlspecialchars($booking_email_err); ?></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required aria-required="true">
                <span class="error-message" id="phoneError"><?php echo htmlspecialchars($phone_err); ?></span>
            </div>
            <div class="form-group">
                <label for="service_type">Select Service Type:</label>
                <select id="service_type" name="service_type" required aria-required="true">
                    <option value="">-- Please Select --</option>
                    <?php foreach ($services_data as $slug => $service): ?>
                        <option value="<?php echo htmlspecialchars($slug); ?>" <?php echo ($service_type === $slug) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($service['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="error-message" id="serviceTypeError"><?php echo htmlspecialchars($service_type_err); ?></span>
                <p id="serviceDescription" class="info-text" style="display: <?php echo !empty($service_type) ? 'block' : 'none'; ?>;">
                    <?php echo !empty($service_type) && isset($services_data[$service_type]['description']) ? htmlspecialchars($services_data[$service_type]['description']) : 'Select a service to see its description.'; ?>
                </p>
            </div>
            <div class="form-group">
                <label for="preferred_date">Preferred Date:</label>
                <input type="date" id="preferred_date" name="preferred_date" value="<?php echo htmlspecialchars($preferred_date); ?>" min="<?php echo date('Y-m-d'); ?>" required aria-required="true">
                <span class="error-message" id="dateError"><?php echo htmlspecialchars($preferred_date_err); ?></span>
            </div>
            <div class="form-group">
                <label for="preferred_time">Preferred Time:</label>
                <input type="time" id="preferred_time" name="preferred_time" value="<?php echo htmlspecialchars($preferred_time); ?>" required aria-required="true">
                <span class="error-message" id="timeError"><?php echo htmlspecialchars($preferred_time_err); ?></span>
            </div>
            <div class="form-group">
                <label for="issue_description">Describe Your Issue/Project Needs (min 20 characters):</label>
                <textarea id="issue_description" name="issue_description" rows="7" required aria-required="true"><?php echo htmlspecialchars($issue_description); ?></textarea>
                <span class="error-message" id="descriptionError"><?php echo htmlspecialchars($issue_description_err); ?></span>
            </div>
            <button type="submit" class="button primary-button">Submit Request</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>