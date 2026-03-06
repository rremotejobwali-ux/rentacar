<?php
// support.php
require_once 'includes/db.php';
include 'includes/header.php';
?>

<section class="section-hero">
    <h1>24/7 Premium Support</h1>
    <p>We're here to help you with any questions or issues, anytime, anywhere.</p>
</section>

<div class="auth-container" style="max-width: 800px;">
    <div class="auth-header">
        <h2>Get in Touch</h2>
        <p>Send us a message and our team will get back to you within 2 hours.</p>
    </div>

    <form action="#" method="POST" class="auth-form" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required>
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label for="subject">Subject</label>
            <select id="subject" name="subject" required style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border);">
                <option value="Booking Issue">Booking Issue</option>
                <option value="Refund">Refund Request</option>
                <option value="Feedback">Feedback</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" placeholder="How can we help you today?" required style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); font-family: inherit; resize: vertical;"></textarea>
        </div>
        <div style="grid-column: span 2;">
            <button type="submit" class="btn-auth">Send Message</button>
        </div>
    </form>
</div>

<div class="support-channels" style="display: flex; justify-content: center; gap: 4rem; margin: 4rem 0; text-align: center;">
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">📞</div>
        <h4 style="font-size: 1.25rem;">Call Us</h4>
        <p style="color: var(--text-muted);">+1 (234) 567-890</p>
    </div>
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">✉️</div>
        <h4 style="font-size: 1.25rem;">Email Us</h4>
        <p style="color: var(--text-muted);">support@rentacar.com</p>
    </div>
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">📍</div>
        <h4 style="font-size: 1.25rem;">Visit Us</h4>
        <p style="color: var(--text-muted);">Global HQ, NY</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php
// support.php
require_once 'includes/db.php';
include 'includes/header.php';
?>

<section class="section-hero">
    <h1>24/7 Premium Support</h1>
    <p>We're here to help you with any questions or issues, anytime, anywhere.</p>
</section>

<div class="auth-container" style="max-width: 800px;">
    <div class="auth-header">
        <h2>Get in Touch</h2>
        <p>Send us a message and our team will get back to you within 2 hours.</p>
    </div>

    <form action="#" method="POST" class="auth-form" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="john@example.com" required>
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label for="subject">Subject</label>
            <select id="subject" name="subject" required style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border);">
                <option value="Booking Issue">Booking Issue</option>
                <option value="Refund">Refund Request</option>
                <option value="Feedback">Feedback</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group" style="grid-column: span 2;">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" placeholder="How can we help you today?" required style="width: 100%; padding: 0.75rem; border-radius: 10px; border: 1px solid var(--border); font-family: inherit; resize: vertical;"></textarea>
        </div>
        <div style="grid-column: span 2;">
            <button type="submit" class="btn-auth">Send Message</button>
        </div>
    </form>
</div>

<div class="support-channels" style="display: flex; justify-content: center; gap: 4rem; margin: 4rem 0; text-align: center;">
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">📞</div>
        <h4 style="font-size: 1.25rem;">Call Us</h4>
        <p style="color: var(--text-muted);">+1 (234) 567-890</p>
    </div>
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">✉️</div>
        <h4 style="font-size: 1.25rem;">Email Us</h4>
        <p style="color: var(--text-muted);">support@rentacar.com</p>
    </div>
    <div>
        <div style="font-size: 2.5rem; margin-bottom: 1rem;">📍</div>
        <h4 style="font-size: 1.25rem;">Visit Us</h4>
        <p style="color: var(--text-muted);">Global HQ, NY</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
