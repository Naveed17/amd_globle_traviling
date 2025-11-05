@extends('common.layout')
@section('content')



    <!-- Contact Hero Section -->
    <section class="contact-hero-section">
        <div class="container">
            <div class="contact-hero-content">
                <h1 class="contact-hero-title">Get In Touch</h1>
                <p class="contact-hero-subtitle">We're here to help you with all your travel needs. Reach out to us anytime and experience world-class customer support!</p>
                <div class="contact-hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-number">24/7</div>
                        <div class="hero-stat-label">Support Available</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">5M+</div>
                        <div class="hero-stat-label">Happy Customers</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number">1hr</div>
                        <div class="hero-stat-label">Average Response</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="contact-info-section">
        <div class="container">
            <div class="contact-info-grid">
                <!-- Visit Office Card -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h3>Visit Our Office</h3>
                    <p>Charlottenstraße 17, 52070 Aachen<br>Germany</p>
                    <!-- <a href="https://maps.google.com" target="_blank" class="contact-link"> -->
                        <!-- Get Directions <i class="bi bi-arrow-right"></i> -->
                    <!-- </a> -->
                </div>

                <!-- Call Us Card -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3>Call Us</h3>
                    <p>+49 179 7296856<br><small>Mon-Fri: 9:30AM-6PM<br>Sat-Sun: Off</small></p>
                    <a href="tel:+491797296856" class="contact-link">
                        Call Now <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <!-- Email Us Card -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h3>Email Us</h3>
                    <p>team@amdglobal.de<br><small>We respond within 1 hour<br>during business hours</small></p>
                    <a href="mailto:team@amdglobal.de" class="contact-link">
                        Send Email <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-form-section">
    <div class="container">
        <div class="contact-main-content">
            <!-- Contact Form -->
            <div class="contact-form-container" style="max-width: 100%; width: 100%;">
                <div class="form-header">
                    <h2>Send Us a Message</h2>
                    <p>Fill out the form below and we'll get back to you as soon as possible. Your feedback is important to us!</p>
                </div>

                <!-- Success Message -->
                <div id="successMessage" class="alert alert-success" style="display: none; margin-bottom: 20px; padding: 15px; border-radius: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                    <i class="bi bi-check-circle"></i>
                    <span id="successText"></span>
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="alert alert-danger" style="display: none; margin-bottom: 20px; padding: 15px; border-radius: 10px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
                    <i class="bi bi-exclamation-triangle"></i>
                    <span id="errorText"></span>
                </div>

                <form class="contact-form" id="contactForm">
                    @csrf
                    <!-- Name Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name *</label>
                            <input type="text" class="form-input" name="firstName" required placeholder="Enter your first name">
                            <span class="error-text" id="error-firstName"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name *</label>
                            <input type="text" class="form-input" name="lastName" required placeholder="Enter your last name">
                            <span class="error-text" id="error-lastName"></span>
                        </div>
                    </div>

                    <!-- Contact Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-input" name="email" required placeholder="your.email@example.com">
                            <span class="error-text" id="error-email"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" name="phone" placeholder="+92 300 1234567">
                            <span class="error-text" id="error-phone"></span>
                        </div>
                    </div>

                    <!-- Subject Field -->
                    <div class="form-group">
                        <label class="form-label">Subject *</label>
                        <select class="form-select" name="subject" required>
                            <option value="">Select a topic</option>
                            <option value="booking">Booking Assistance</option>
                            <option value="cancellation">Cancellation/Refund</option>
                            <option value="modification">Flight Modification</option>
                            <option value="complaint">Complaint</option>
                            <option value="feedback">Feedback</option>
                            <option value="partnership">Business Partnership</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="error-text" id="error-subject"></span>
                    </div>

                    <!-- Booking Reference -->
                    <div class="form-group">
                        <label class="form-label">Booking Reference (if applicable)</label>
                        <input type="text" class="form-input" name="bookingRef" placeholder="e.g., AMD123456">
                        <span class="error-text" id="error-bookingRef"></span>
                    </div>

                    <!-- Message Field -->
                    <div class="form-group">
                        <label class="form-label">Message *</label>
                        <textarea class="form-textarea form-input" name="message" rows="6" placeholder="Please provide as much detail as possible about your inquiry..." required></textarea>
                        <small class="form-help">Minimum 10 characters</small>
                        <span class="error-text" id="error-message"></span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <i class="bi bi-paper-plane"></i>
                        <span id="btnText">Send Message</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
.error-text {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

.form-input.error {
    border-color: #dc3545;
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    
    // Clear previous errors
    document.querySelectorAll('.error-text').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-input').forEach(el => el.classList.remove('error'));
    successMessage.style.display = 'none';
    errorMessage.style.display = 'none';
    
    // Disable submit button
    submitBtn.disabled = true;
    btnText.textContent = 'Sending...';
    
    try {
        const formData = new FormData(form);
        
        const response = await fetch('{{ route("contact.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Show success message
            document.getElementById('successText').textContent = data.message;
            successMessage.style.display = 'block';
            
            // Reset form
            form.reset();
            
            // Scroll to top
            successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            // Show validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorElement = document.getElementById(`error-${key}`);
                    const inputElement = document.querySelector(`[name="${key}"]`);
                    
                    if (errorElement) {
                        errorElement.textContent = data.errors[key][0];
                    }
                    if (inputElement) {
                        inputElement.classList.add('error');
                    }
                });
            } else {
                document.getElementById('errorText').textContent = data.message || 'Something went wrong. Please try again.';
                errorMessage.style.display = 'block';
            }
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('errorText').textContent = 'Network error. Please check your connection and try again.';
        errorMessage.style.display = 'block';
    } finally {
        // Re-enable submit button
        submitBtn.disabled = false;
        btnText.textContent = 'Send Message';
    }
});
</script>

 

@endsection
