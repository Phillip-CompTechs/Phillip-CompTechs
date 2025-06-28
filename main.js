// Universal Modal Functions
function openUniversalModal(title, content) {
    const modal = document.getElementById('universalModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');

    if (modal && modalTitle && modalBody) {
        modalTitle.textContent = title;
        modalBody.innerHTML = content; // Use innerHTML for rich content
        modal.style.display = 'flex'; // Use flex to center
        document.body.classList.add('modal-open'); // Prevent body scrolling
        modal.focus(); // Set focus to the modal for accessibility
    } else {
        console.error('Universal modal elements not found.');
    }
}

function closeUniversalModal() {
    const modal = document.getElementById('universalModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open');
        // Optionally clear content after closing
        // document.getElementById('modalTitle').textContent = '';
        // document.getElementById('modalBody').innerHTML = '';
    }
}

// Close the modal if the user clicks anywhere outside of the modal content
window.addEventListener('click', function(event) {
    const modal = document.getElementById('universalModal');
    if (modal && event.target === modal) {
        closeUniversalModal();
    }
});

// Close modal with ESC key for accessibility
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('universalModal');
    if (event.key === 'Escape' && modal && modal.style.display === 'flex') {
        closeUniversalModal();
    }
});


// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const dropdownLink = document.querySelector('.dropdown > a');
    const dropdownContent = document.querySelector('.dropdown-content');

    // Toggle hamburger and nav links
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
            // Ensure dropdown is closed if mobile menu is toggled off
            if (!navLinks.classList.contains('active')) {
                if (dropdownContent) {
                    dropdownContent.classList.remove('show');
                }
            }
        });
    }

    // Handle dropdown on mobile screens
    if (dropdownLink && dropdownContent) {
        // Prevent default navigation for the services link when it's meant to open dropdown
        dropdownLink.addEventListener('click', (e) => {
            // Only prevent default if on mobile/tablet view and the nav is currently active
            if (window.innerWidth <= 768 && navLinks.classList.contains('active')) {
                e.preventDefault();
                dropdownContent.classList.toggle('show');
            }
        });

        // Close dropdown if screen resizes to desktop or nav is no longer active (from main.js)
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                dropdownContent.classList.remove('show');
            }
        });
    }

    // Close mobile nav when any nav link (including dropdown items) is clicked
    if (navLinks) {
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                // Check if it's not the dropdown parent link on mobile
                if (window.innerWidth <= 768 && link !== dropdownLink) {
                    hamburger.classList.remove('active');
                    navLinks.classList.remove('active');
                    if (dropdownContent) {
                        dropdownContent.classList.remove('show');
                    }
                }
            });
        });
    }
});

