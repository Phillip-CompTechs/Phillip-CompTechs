<?php
// Computer Repair Services

$services = [
    'Computer Repair' => [
        'description' => 'We provide comprehensive computer repair services including hardware repairs, software troubleshooting, and virus removal. Our team is skilled in diagnosing issues and offering effective solutions.',
        'pricing' => 'Pricing varies based on the service required, please contact us for a quote.',
        'contact' => 'You can reach us at contact@phillipcomptechs.com '
    ],
    'Printer Repair' => [
        'description' => 'Our printer repair services cover a wide range of issues from paper jams to connectivity problems. We also provide maintenance services to keep your printer in optimal condition.',
        'pricing' => 'Pricing varies based on the issue, please contact us for a quote.',
        'contact' => 'You can reach us at contact@phillipcomptechs.com '
    ]
];

// Function to display services
function displayServices($services) {
    foreach ($services as $service => $details) {
        echo "<h2>" . $service . "</h2>";
        echo "<p>" . $details['description'] . "</p>";
        echo "<p><strong>Pricing:</strong> " . $details['pricing'] . "</p>";
        echo "<p><strong>Contact:</strong> " . $details['contact'] . "</p>";
    }
}

displayServices($services);
?>