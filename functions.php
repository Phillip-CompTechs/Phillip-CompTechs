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
// Define the base path for data storage (important for file_put_contents)
define('DATA_PATH', __DIR__ . '/../data/');

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    // ENT_QUOTES encodes both single and double quotes
    // UTF-8 ensures proper character encoding
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Function to handle form submissions (basic file storage for demonstration)
function handle_form_submission($form_type, $data) {
    $file_path = DATA_PATH . $form_type . '.txt';

    // Create data directory if it doesn't exist
    if (!is_dir(DATA_PATH)) {
        if (!mkdir(DATA_PATH, 0755, true)) { // 0755 permissions for directory
            error_log("Failed to create data directory: " . DATA_PATH);
            return false;
        }
    }

    $entry = "[" . date("Y-m-d H:i:s") . "] " . json_encode($data) . "\n";

    // FILE_APPEND: Appends to the file.
    // LOCK_EX: Acquire an exclusive lock on the file while writing. This prevents multiple writes at once.
    if (file_put_contents($file_path, $entry, FILE_APPEND | LOCK_EX) !== false) {
        return true;
    }
    error_log("Failed to write to file: " . $file_path); // Log error for debugging
    return false;
}

// Dummy service data (In a real professional app, this would typically come from a database)
$services_data = [
    'computer-repair' => [
        'title' => 'Computer Repair',
        'subtitle' => 'Expert diagnostics and repair for all computer issues.',
        'description' => 'Is your computer running slow, crashing, or refusing to boot? Our certified technicians specialize in diagnosing and fixing a wide range of computer problems, including hardware failures, software glitches, virus removal, operating system issues, data recovery, and performance optimization. We work with both Windows and macOS systems, ensuring your device gets back to optimal performance quickly and efficiently.',
        'features' => [
            'Diagnostic Services & Troubleshooting',
            'Hardware Upgrades & Replacement',
            'Software Installation & Configuration',
            'Virus, Malware & Spyware Removal',
            'Operating System Reinstallation & Updates',
            'Data Backup, Transfer & Recovery',
            'Network & Connectivity Issues',
            'Performance Optimization & Cleaning'
        ],
        'image' => 'images/computer_repair_hero.jpg' // Placeholder, replace with your image
    ],
    'phone-repair' => [
        'title' => 'Phone Repair',
        'subtitle' => 'Quick and reliable repairs for smartphones and tablets.',
        'description' => 'Dropped your phone? Cracked screen? Battery issues? We offer fast and reliable repair services for a wide range of smartphones and tablets (iOS and Android). From screen replacements and battery swaps to water damage repair and charging port fixes, we get your device back in your hands quickly and looking like new.',
        'features' => [
            'Screen & LCD Replacement',
            'Battery Replacement',
            'Charging Port Repair',
            'Water Damage Restoration',
            'Speaker & Microphone Repair',
            'Home Button & Power Button Fixes',
            'Camera Repair',
            'Software Flashing & Unlocking'
        ],
        'image' => 'images/phone_repair_hero.jpg' // Placeholder, replace with your image
    ],
    'web-development' => [
        'title' => 'Web Development',
        'subtitle' => 'Custom websites and web applications tailored to your needs.',
        'description' => 'Need a strong online presence? We specialize in creating responsive, user-friendly, and high-performance websites and web applications. Whether you need a simple brochure site, a robust e-commerce platform, a dynamic content management system, or a complex custom web application, we use modern technologies to bring your vision to life and help your business thrive online.',
        'features' => [
            'Custom Website Design & Development',
            'E-commerce Solutions (e.g., Shopify, WooCommerce)',
            'Content Management Systems (e.g., WordPress Customization)',
            'Responsive & Mobile-Friendly Design',
            'Web Application Development (Frontend & Backend)',
            'Website Maintenance & Support',
            'SEO Optimization Basics',
            'Hosting & Domain Management Assistance'
        ],
        'image' => 'images/web_dev_hero.jpg' // Placeholder, replace with your image
    ],
    'design-making' => [
        'title' => 'Design Making',
        'subtitle' => 'Stunning graphic design to enhance your brand identity.',
        'description' => 'First impressions matter. Our design team creates captivating visuals that resonate with your audience and strengthen your brand. From memorable logos and comprehensive branding guidelines to engaging marketing materials, stunning UI/UX design, and appealing social media graphics, we ensure your visual communication is impactful, professional, and consistent across all platforms.',
        'features' => [
            'Logo Design & Brand Identity',
            'UI/UX Design for Web & Mobile Applications',
            'Brochure, Flyer & Poster Design',
            'Social Media Graphics & Campaigns',
            'Presentation Design',
            'Business Card & Stationery Design',
            'Infographics & Data Visualization',
            'Image Editing & Retouching'
        ],
        'image' => 'images/design_hero.jpg' // Placeholder, replace with your image
    ]
];

// Helper for navigation active state
function is_active_page($current_page_name, $page_slug) {
    return ($current_page_name === $page_slug) ? 'active' : '';
}

// Helper to determine if a service sub-page is active for the main 'Services' link
function is_service_parent_active($current_page_name) {
    return (strpos($current_page_name, 'services_') !== false || $current_page_name === 'services.php') ? 'active' : '';
}
?>
</body>
</html>