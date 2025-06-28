
document.addEventListener('DOMContentLoaded', () => {
    // Client-side Contact Form Validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            let isValid = true;

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

            // Get form elements
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const subjectInput = document.getElementById('subject');
            const messageInput = document.getElementById('message_content');

            // Validate Name
            if (nameInput.value.trim() === '') {
                document.getElementById('nameError').textContent = 'Your name is required.';
                isValid = false;
            } else if (!/^[a-zA-Z\s.-]+$/.test(nameInput.value.trim())) { // Allow letters, spaces, dots, dashes
                document.getElementById('nameError').textContent = 'Name can only contain letters, spaces, dots, or dashes.';
                isValid = false;
            }

            // Validate Email
            if (emailInput.value.trim() === '') {
                document.getElementById('emailError').textContent = 'Your email is required.';
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address.';
                isValid = false;
            }

            // Validate Subject
            if (subjectInput.value.trim() === '') {
                document.getElementById('subjectError').textContent = 'Subject is required.';
                isValid = false;
            }

            // Validate Message
            if (messageInput.value.trim() === '') {
                document.getElementById('messageError').textContent = 'Message cannot be empty.';
                isValid = false;
            } else if (messageInput.value.trim().length < 10) { // Minimum message length
                document.getElementById('messageError').textContent = 'Message must be at least 10 characters long.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Stop form submission if validation fails
            }
        });
    }

    // Google Map Integration
    const mapElement = document.getElementById('map');
    if (mapElement) {
        // Function to initialize the map
        function initMap() {
            // TechSolutions Hub Location (Harare, Zimbabwe example)
            const techSolutionsCoords = { lat: -17.825169, lng: 31.050854 }; // Example: Center of Harare

            const map = new google.maps.Map(mapElement, {
                zoom: 15,
                center: techSolutionsCoords,
                mapTypeId: google.maps.MapTypeId.ROADMAP, // Or SATELLITE, HYBRID, TERRAIN
                fullscreenControl: false, // Optional: disable fullscreen button
                streetViewControl: false, // Optional: disable street view button
                mapTypeControl: false, // Optional: disable map type control
            });

            new google.maps.Marker({
                position: techSolutionsCoords,
                map: map,
                title: 'TechSolutions Hub',
                animation: google.maps.Animation.DROP // Optional: drop animation
            });
        }

        // Load the Google Maps API script dynamically
        // IMPORTANT: Replace 'YOUR_API_KEY' with your actual Google Maps JavaScript API key
        // Get one from Google Cloud Console: https://console.cloud.google.com/apis/credentials
        const apiKey = 'YOUR_API_KEY'; // <<< REMEMBER TO CHANGE THIS
        if (apiKey === 'YOUR_API_KEY' || !apiKey) {
            console.warn('Google Maps API Key is missing or default. Map may not load. Please replace "YOUR_API_KEY" in js/contact.js.');
            mapElement.textContent = 'Google Map cannot load without a valid API Key. Please check the console for details.';
            mapElement.style.display = 'flex';
            mapElement.style.justifyContent = 'center';
            mapElement.style.alignItems = 'center';
            mapElement.style.color = '#dc3545';
            mapElement.style.fontSize = '1.1em';
        } else {
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&callback=initMap`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);

            // Make initMap globally available for the callback
            window.initMap = initMap;
        }
    }
});
