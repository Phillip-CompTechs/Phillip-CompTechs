<?php
// Phone Repair Services

// Comprehensive phone repair service details

$services = array(
    'Screen Replacement' => array(
        'description' => 'Replacement of cracked or damaged screens for various phone models.',
        'pricing' => '$199',
        'timeline' => '2-3 hours',
        'contact' => 'Call us at (555) 123-4567 or email support@phillipcomptechs.com'
    ),
    'Water Damage Repair' => array(
        'description' => 'Restoration of phones that have suffered water damage.',
        'pricing' => '$149',
        'timeline' => '1-2 days',
        'contact' => 'Call us at (555) 123-4567 or email support@phillipcomptechs.com'
    ),
    'Battery Replacement' => array(
        'description' => 'Replacing old or faulty batteries for improved performance.',
        'pricing' => '$99',
        'timeline' => '1 hour',
        'contact' => 'Call us at (555) 123-4567 or email support@phillipcomptechs.com'
    ),
    'Software Updates' => array(
        'description' => 'Updating phone software to the latest version.',
        'pricing' => '$49',
        'timeline' => '30 minutes',
        'contact' => 'Call us at (555) 123-4567 or email support@phillipcomptechs.com'
    ),
    'Data Transfer Services' => array(
        'description' => 'Transferring data from old devices to new ones.',
        'pricing' => '$79',
        'timeline' => '1 hour',
        'contact' => 'Call us at (555) 123-4567 or email support@phillipcomptechs.com'
    ),
);

// Function to display service details
function display_services($services) {
    foreach ($services as $service => $details) {
        echo "$service:\n";
        echo "  Description: " . $details['description'] . "\n";
        echo "  Pricing: " . $details['pricing'] . "\n";
        echo "  Timeline: " . $details['timeline'] . "\n";
        echo "  Contact: " . $details['contact'] . "\n\n";
    }
}

// Display all services
display_services($services);
?>