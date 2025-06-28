document.addEventListener('DOMContentLoaded', () => {
const bookingForm = document.getElementById('bookingForm');
const serviceSelect = document.getElementById('service_type');
const serviceDescriptionDiv = document.getElementById('serviceDescription');

// This data is a client-side copy of service descriptions.
// Ensure it matches the PHP $services_data for consistency.
const servicesDataClient = {
    'computer-repair': 'Comprehensive diagnostics, virus removal, hardware & software fixes for laptops and desktops. Our experts handle all major brands and operating systems.',
    'phone-repair': 'Fast and reliable screen replacement, battery issues, water damage, and more for smartphones and tablets. We service iOS and Android devices.',
    'web-development': 'Custom website design, e-commerce solutions, CMS integration, and robust web application development tailored to your business needs.',
    'design-making': 'Professional graphic design services including logo creation, branding, UI/UX design, and marketing material development to elevate your brand identity.'
};

// Update service description based on selection
if (serviceSelect) {
    serviceSelect.addEventListener('change', function() {
        const selectedService = this.value;
        if (selectedService && servicesDataClient[selectedService]) {
            serviceDescriptionDiv.textContent = servicesDataClient[selectedService];
            serviceDescriptionDiv.style.display = 'block';
        } else {
            serviceDescriptionDiv.textContent = 'Select a service to see its description.';
            serviceDescriptionDiv.style.display = 'block'; // Always show this hint
        }
    });
    // Trigger change on load if a service is pre-selected (e.g., from GET parameter)
    if (serviceSelect.value) {
        serviceSelect.dispatchEvent(new Event('change'));
    }
}

// Client-side Booking Form Validation
if (bookingForm) {
    bookingForm.addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

        // Get form elements
        const fullNameInput = document.getElementById('full_name');
        const emailInput = document.getElementById('booking_email');
        const phoneInput = document.getElementById('phone');
        const serviceTypeSelect = document.getElementById('service_type');
        const dateInput = document.getElementById('preferred_date');
        const timeInput = document.getElementById('preferred_time');
        const descriptionInput = document.getElementById('issue_description');

        // Validate Full Name
        if (fullNameInput.value.trim() === '') {
            document.getElementById('fullNameError').textContent = 'Full Name is required.';
            isValid = false;
        } else if (!/^[a-zA-Z\s.-]+$/.test(fullNameInput.value.trim())) {
            document.getElementById('fullNameError').textContent = 'Name can only contain letters, spaces, dots, or dashes.';
            isValid = false;
        }

        // Validate Email
        if (emailInput.value.trim() === '') {
            document.getElementById('bookingEmailError').textContent = 'Email is required.';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
            document.getElementById('bookingEmailError').textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        // Validate Phone Number
        if (phoneInput.value.trim() === '') {
             document.getElementById('phoneError').textContent = 'Phone number is required.';
             isValid = false;
        } else if (!/^\+?[0-9\s-()]{7,20}$/.test(phoneInput.value.trim())) { // Basic phone regex
            document.getElementById('phoneError').textContent = 'Please enter a valid phone number (min 7 digits).';
            isValid = false;
        }

        // Validate Service Type
        if (serviceTypeSelect.value === '') {
            document.getElementById('serviceTypeError').textContent = 'Please select a service type.';
            isValid = false;
        }

        // Validate Preferred Date (check for future date)
        if (dateInput.value.trim() === '') {
            document.getElementById('dateError').textContent = 'Preferred date is required.';
            isValid = false;
        } else {
            const selectedDate = new Date(dateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time for accurate date comparison
            if (selectedDate < today) {
                document.getElementById('dateError').textContent = 'Please select a future date.';
                isValid = false;
            }
        }

        // Validate Preferred Time
        if (timeInput.value.trim() === '') {
            document.getElementById('timeError').textContent = 'Preferred time is required.';
            isValid = false;
        }
        // Optional: Add more specific time validation (e.g., within business hours)

        // Validate Description
        if (descriptionInput.value.trim() === '') {
            document.getElementById('descriptionError').textContent = 'Please describe your issue/project needs.';
            isValid = false;
        } else if (descriptionInput.value.trim().length < 20) { // Minimum description length
            document.getElementById('descriptionError').textContent = 'Description must be at least 20 characters long.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Stop form submission if validation fails
        }
    });
}
});
