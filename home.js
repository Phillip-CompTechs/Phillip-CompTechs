document.addEventListener('DOMContentLoaded', () => {
    // Testimonial Slider
    const testimonialContainer = document.querySelector('.testimonial-container');
    const dotsContainer = document.querySelector('.slider-dots');
    let currentIndex = 0;
    let autoSlideInterval; // To store the interval ID

    if (testimonialContainer && dotsContainer) {
        const testimonials = Array.from(testimonialContainer.children); // Convert HTMLCollection to Array

        if (testimonials.length > 0) {
            // Clone first and last items for infinite loop effect (optional, more complex)
            // For now, it's a simple bounded slider

            // Create dots
            dotsContainer.innerHTML = ''; // Clear any existing dots
            testimonials.forEach((_, index) => {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                if (index === 0) dot.classList.add('active');
                dot.setAttribute('data-index', index); // Custom attribute for easy lookup
                dot.addEventListener('click', () => {
                    goToSlide(index);
                    resetAutoSlide(); // Reset timer on manual navigation
                });
                dotsContainer.appendChild(dot);
            });

            const dots = Array.from(dotsContainer.children);

            // Function to update the slider position
            function updateSlider() {
                // Calculate total width of all testimonials + their margins
                // Assuming all testimonials have the same width and horizontal margin
                const itemWidth = testimonials[0].offsetWidth +
                                  (parseFloat(getComputedStyle(testimonials[0]).marginLeft) * 2);

                testimonialContainer.style.transform = `translateX(${-currentIndex * itemWidth}px)`;

                // Update active dot
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
            }

            // Function to navigate to a specific slide
            function goToSlide(index) {
                currentIndex = index;
                if (currentIndex < 0) {
                    currentIndex = testimonials.length - 1;
                } else if (currentIndex >= testimonials.length) {
                    currentIndex = 0;
                }
                updateSlider();
            }

            // Auto-slide functionality
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    goToSlide(currentIndex + 1); // Move to next slide
                }, 7000); // Change slide every 7 seconds
            }

            function resetAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            // Initial render
            updateSlider();
            startAutoSlide(); // Start auto-sliding

            // Recalculate on resize to handle responsive changes (e.g., itemWidth changes)
            window.addEventListener('resize', () => {
                updateSlider();
                resetAutoSlide(); // Reset auto-slide timer after resize
            });
        }
    }
});
